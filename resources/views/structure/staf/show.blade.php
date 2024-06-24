@extends('layouts.admin')

@section('main-content')
    <!-- Main Content goes here -->
    <div class="row">
        <div class="col">
            <div class="card mb-4 shadow">
                <div class="card-header py-3">
                    <h3 class="font-weight-bold text-primary m-0">{{ $title ?? __('Blank Page') }}</h3>
                </div>
                <div class="card-body">

                        <div class="form-group">
                            <label for="staff_id">{{ __('Petugas') }}</label>
                            <select disabled name="staff_id" id="staff_id" class="form-control" name="staff_id">
                                <option value="" selected>-- Pilih --</option>
                                @foreach ($positions as $item)
                                    <option value="{{ $item->id }}" {{$record->staff_id == $item->id ??  old('staff_id') ? 'selected' : ''}}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">{{__('Jabatan')}}</label>
                            <input disabled type="text" name="name" class="form-control" id="form-control" @error('name') is-invalid @enderror" name="name"
                            id="name" placeholder="Staff" autocomplete="off" value="{{ $record->name ?? old('name') }}">
                        </div>


                        <div class="form-group">
                            <label for="parent_id">{{__('Pimpinan')}}</label>
                            <select disabled name="parent_id" id="parent_id" class="form-control" name="parent_id">
                                <option value="" selected>-- Pilih --</option>
                                @foreach ($positions as $item)
                                    <option value="{{$item->id}}" {{$record->parent_id == $item->id ??  old('parent_id') ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('staf.index') }}" class="btn btn-default">{{__('Kembali')}}</a>

                </div>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->
@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
