@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')
    <div class=" container">
        <div class='container-fluid'>

            <h1>My Cart</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            </thead>

            <tbody>

            <?php foreach(Cart::content() as $row) :?>

            <tr>
                <td>
                    <p><strong><a href="/posts/{{$row->id}}"><?php echo $row->name; ?></a></strong></p>
                    <p><?php //echo ($row->id); ?></p>
                    <p><?php //echo $row->id ?></p>
                </td>
                <td><?php echo $row->qty; ?>pcs.</td>
                <td>₱<?php echo $row->price; ?></td>
                <td>₱<?php echo (($row->price)*($row->qty)); ?></td>

                <td><form action="{{ route('cart.destroy', $row->rowId) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form></td>
            </tr>

            <?php endforeach;?>

            </tbody>

            <tfoot>
            <tr>
                <td colspan="2">&nbsp;</td>
                <td>Subtotal</td>
                <td>₱<?php echo Cart::subtotal(); ?></td>
            </tr>


            </tfoot>
        </table>

            <div class="cart-buttons">
                <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
               {{-- <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>--}}
            <hr>


                        <a href="{{ route('transaction.create') }}" class="btn btn-success mb-2">Proceed</a>

            </div>

        </div>
    </div>


@endsection

@section('footer_scripts')
@endsection