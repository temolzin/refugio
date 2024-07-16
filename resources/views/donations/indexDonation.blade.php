<div class="modal fade" id="indexDonation{{ $shelterMember->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-secondary">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h4 class="card-title">Donaciones de {{ $shelterMember->name }} {{ $shelterMember->last_name }}
                        </h4>
                        <button type="button" class="close d-sm-inline-block text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                @php
                    $memberDonations = $donations->where('shelter_member_id', $shelterMember->id);
                @endphp
                <div class="modal-body">
                    @if (count($memberDonations) <= 0)
                        <p>No hay donaciones registradas para este miembro.</p>
                    @else
                        @foreach ($memberDonations as $donation)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                        <strong>Tipo de Donación:</strong> {{ $donation->type }}
                                        <br>
                                        <strong>Monto:</strong> ${{ number_format($donation->amount, 2) }}
                                    </p>
                                    <div class="btn-group" role="group" aria-label="Options">
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal" title="Ver donación"
                                            data-target="#viewDonation{{ $donation->id }}">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>
                                        <button type="button" class="btn btn-danger mr-2" data-toggle="modal"
                                            title="Eliminar donación" data-target="#deleteDonation{{ $donation->id }}">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </div>
                                    @include('donations.viewDonation')
                                </div>
                            </div>
                            @include('donations.deleteDonation')
                        @endforeach
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
