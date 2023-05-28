<div class="charts">
  <div class="chart">
    <div>
      <canvas id="vehiculesChart" ></canvas>
    </div>
  </div>
  <div class="chart">
    <div>
      <canvas id="paidUnpaidContratsChart" ></canvas>
    </div>
  </div>
  <div class="chart">
    <h4>Mes contrats et reservations par mois / {{date('Y')}}</h4>
    <div>
      <canvas id="userReservationsContratsChart"></canvas>
    </div>
  </div>
  @if (auth()->user()->role == 'admin')
    <div class="chart">
      <div>
        <canvas id="agentsChart" ></canvas>
      </div>
    </div>
    <div class="chart">
      <h4>Contrats et Reservations par mois / {{date('Y')}}</h4>
      <div>
        <canvas id="reservationsContrats"></canvas>
      </div>
    </div>
    <div class="chart">
      <h4>Dépenses et Gains par mois / {{date('Y')}}</h4>
      <div>
        <canvas id="depensesGainsChart"></canvas>
      </div>
    </div>
  @endif
</div>