<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Contrat;
use App\Models\Reglement;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $reservations = ($user->isAdmin()) ? Reservation::count(): $user->reservations()->count();
        $vehiculesLoués = Vehicule::where('status', 'loué')->count();
        $vehiculesDispo = Vehicule::where('status', 'disponible')->count();
        $vehiculesEnPanne = Vehicule::where('status', 'en panne')->count();
        $alertes = AlerteController::alertesCount();
        $gains = Reglement::sum('montant');
        $depenses = Charge::sum('cout');
        return view('dashboard.index', compact('reservations', 'vehiculesLoués', 'vehiculesDispo', 'vehiculesEnPanne', 'alertes', 'gains', 'depenses'));
    }

    public function vehiculesChart()
    {
        $vehiculesLoués = Vehicule::where('status', 'loué')->count();
        $vehiculesDispo = Vehicule::where('status', 'disponible')->count();
        $vehiculesEnPanne = Vehicule::where('status', 'en panne')->count();
        return response()->json(['labels' => ['En Panne', 'Disponible', 'Loué'], 'data' => [$vehiculesEnPanne, $vehiculesDispo, $vehiculesLoués]]);
    }

    public function agentContratsChart()
    {
        $agentsData = User::withCount('contrats')->get(['id', 'nom', 'contrats_count']);
        $agentNames = $agentsData->pluck('nom', 'id')->toArray();
        $contratCounts = $agentsData->pluck('contrats_count')->toArray();

        // Get the connected user's name
        $connectedUser = auth()->user()->id;

        // Check and update the name if it matches the connected user
        foreach ($agentNames as $id => $name) {
            if ($id === $connectedUser) {
                $agentNames[$id] = 'Moi';
            }
        }
        return response()->json(['labels' => array_values($agentNames), 'data' => $contratCounts]);
    }

    public function userReservationsContrats()
    {
        // Get the connected user's ID
        $userId = auth()->user()->id;

        // Get the current year
        $currentYear = Carbon::now()->year;

        // Initialize the contract counts array with 0 values for all months
        $contratCounts = array_fill(1, 12, 0);
        $reservationCounts = array_fill(1, 12, 0);

        // Query to retrieve the contract counts for each month of the current year
        $contractData = DB::table('contrats')
                        ->select(DB::raw('MONTH(date_contrat) as month'), DB::raw('COUNT(*) as count'))
                        ->whereYear('date_contrat', $currentYear)
                        ->where('user_id', $userId)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        foreach ($contractData as $data) {
            $contratCounts[$data->month] = $data->count;
        }

        // Query to retrieve the reservation counts for each month of the current year
        $reservationData = DB::table('reservations')
                            ->select(DB::raw('MONTH(date_reservation) as month'), DB::raw('COUNT(*) as count'))
                            ->whereYear('date_reservation', $currentYear)
                            ->where('user_id', $userId)
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

        foreach ($reservationData as $data) {
            $reservationCounts[$data->month] = $data->count;
        }

        return response()->json([
            'labels' => $this->passedMonths(),
            'contracts' => array_values($contratCounts),
            'reservations' => array_values($reservationCounts)
        ]);

    }

    public function paidUnpaidContrats()
    {

        $paidContrats = (auth()->user()->isAdmin()) ? Contrat::where('status', 'payé')->count() : Contrat::where('status', 'payé')->where('user_id', auth()->user()->id)->count();
        $unpaidContrats = (auth()->user()->isAdmin()) ? Contrat::where('status', 'impayé')->count() : Contrat::where('status', 'impayé')->where('user_id', auth()->user()->id)->count();
        return response()->json(['labels' => ['Payé', 'Impayé'], 'data' => [$paidContrats, $unpaidContrats]]);
    }

    public function reservationsContrats()
    {
        // Get the current year
        $currentYear = Carbon::now()->year;

        $contratCounts = array_fill(1, 12, 0);
        $reservationCounts = array_fill(1, 12, 0);

        // Query to retrieve the contract counts for each month of the current year
        $contratData = DB::table('contrats')
            ->select(DB::raw('MONTH(date_contrat) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('date_contrat', $currentYear)
            ->whereNull('deleted_at')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // month => Contrat count
        foreach ($contratData as $data) {
            $month = $data->month;
            $count = $data->count;
            $contratCounts[$month] = $count;
        };

        // Query to retrieve the reservation counts for each month of the current year
        $reservationData = DB::table('reservations')
            ->select(DB::raw('MONTH(date_reservation) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('date_reservation', $currentYear)
            ->whereNull('deleted_at')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // month => Reservation count   
        foreach ($reservationData as $data) {
            $month = $data->month;
            $count = $data->count;
            $reservationCounts[$month] = $count;
        }

        return response()->json([
            'labels' => $this->passedMonths(),
            'contracts' => array_values($contratCounts),
            'reservations' => array_values($reservationCounts)
        ]);
    }

    public function depensesGains()
    {
        $currentYear = Carbon::now()->year;

        $gains = array_fill(1, 12, 0);
        $depenses = array_fill(1, 12, 0);

        $gainsData = DB::table('reglements')
            ->select(DB::raw('MONTH(date_reglement) as month'), DB::raw('SUM(montant) as montant'))
            ->whereYear('date_reglement', $currentYear)
            ->whereNull('deleted_at')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // month => Gains montant
        foreach ($gainsData as $data) {
            $gains[$data->month] = $data->montant;
        };

        $depensesData = DB::table('charges')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(cout) as montant'))
            ->whereYear('date', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // month => Depenses montant   
        foreach ($depensesData as $data) {
            $depenses[$data->month] = $data->montant;
        }

        return response()->json([
            'labels' => $this->passedMonths(),
            'gains' => array_values($gains),
            'depenses' => array_values($depenses)
        ]);
    }

    private function passedMonths()
    {
        $currentMonth = Carbon::now()->month;
        $months = [];

        for ($i = 1; $i <= $currentMonth; $i++) {
            $monthName = Carbon::create()->month($i)->isoFormat('MMMM');
            $months[] = ucfirst($monthName);
        }
        return $months;
    }


}   
