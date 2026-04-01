<!DOCTYPE html>
<html>
<head>
    <style>
   
        body { font-family: sans-serif; font-size: 12px; margin: 0; padding: 10px; width: 260px; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .items { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .items th, .items td { text-align: left; padding: 4px 0; border-bottom: 1px dashed #000; }
        .total { text-align: right; font-weight: bold; font-size: 16px; margin-top: 10px; }
        .footer { text-align: center; margin-top: 15px; font-size: 10px; color: #555; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Softlixs</h1>
        <p>Ticket de Consumo<br>Pedido N° {{ $order->id }}</p>
    </div>
    
    <table class="items">
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Producto</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->product->name }}</td> 
                <td style="text-align: right;">${{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="total">
        TOTAL: ${{ number_format($order->total_price, 2, ',', '.') }}
    </div>
    
    <div class="footer">
        ¡Gracias por tu compra!<br>
        {{ $order->created_at->format('d/m/Y H:i') }}
    </div>
</body>
</html>