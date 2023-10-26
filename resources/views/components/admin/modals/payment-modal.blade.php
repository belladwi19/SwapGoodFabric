@if ($show)
    @props(['serviceTypes', 'totalPrice', 'show' => false])

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Bayar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.transactions.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="sub-total">Sub Total *</label>
                            <input type="number" class="form-control form-control-lg" id="sub-total"
                                value="{{ isset($totalPrice) ? $totalPrice : '0' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="service-type">Tipe Servis *</label>
                            <select name="service-type" class="form-control form-control-lg" id="service-type" required>
                                @foreach ($serviceTypes as $type)
                                    <option value="{{ $type->id }}" data-type-cost="{{ $type->cost }}">
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="total-harga">Harga Yang Dibayar</label>
                            <input type="number" class="form-control form-control-lg" id="total-harga"
                                value="{{ isset($totalPrice) ? $totalPrice : '0' }}" disabled>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" id="btn-simpan" type="button" class="btn btn-primary">Bayar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script src="{{ asset('js/quantity-increment.js') }}"></script>
        <script src="{{ asset('js/input-transaksi.js') }}"></script>
    @endpush
@endif
