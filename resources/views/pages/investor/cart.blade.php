@extends('layouts.app')

@section('template_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('content')


    <table class="table table-striped">
        <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach(Cart::content() as $row) :?>

        <tr>
            <td>
                <p><strong><?php echo $row->name; ?></strong></p>
                <p><?php echo ($row->options->has('size') ? $row->options->size : ''); ?></p>
            </td>
            <td><input type="text" value="<?php echo $row->qty; ?>"></td>
            <td>$<?php echo $row->price; ?></td>
            <td>$<?php echo $row->total; ?></td>
        </tr>

        <?php endforeach;?>

        </tbody>

        <tfoot>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td>Subtotal</td>
            <td><?php echo Cart::subtotal(); ?></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td><b>Tax</b></td>
            <td><?php echo Cart::tax(); ?></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td><b>Total</b></td>
            <td><?php echo Cart::total(); ?></td>
        </tr>
        </tfoot>
    </table>


@endsection

@section('footer_scripts')
@endsection