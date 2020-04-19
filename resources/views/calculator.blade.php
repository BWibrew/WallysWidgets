@extends('base')

@section('content')
    <div class="text-center">
        <h1>Wally's Widgets</h1>
        <p class="lead">
            Calculate the optimum number & size of packs to fulfill an order of widgets
        </p>
    </div>

    <div class="card p-3">
        <div class="card-body">
            <div class="card-title">
                <h2>Calculate pack sizes</h2>
            </div>
            <form method="get" target="/">
                <div class="form-group">
                    <label for="widget-count">No. of widgets</label>
                    <input
                        id="widget-count"
                        class="form-control"
                        name="widget-count"
                        type="number"
                        value="{{ $widgetCount }}"
                    >
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    @if($widgetCount !== null)
        <div class="card p-3 mt-2">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{ $widgetCount }} widgets require:</h2>
                </div>
                <table class="table w-75 mx-auto">
                    <thead>
                        <tr>
                            <th scope="col">Pack Size</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">500</th>
                            <td>1</td>
                        </tr>
                        <tr>
                            <th scope="row">250</th>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

@endsection