<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmation de votre commande</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #F8F6F3;
            color: #1A1A1A;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            -ms-text-size-adjust: none;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #FFFFFF;
            border: 1px solid #EBEBEB;
        }
        .header {
            background-color: #1A1A1A;
            padding: 30px 40px;
            text-align: center;
        }
        .header h1 {
            color: #FFFFFF;
            font-family: Georgia, serif;
            font-size: 24px;
            margin: 0;
            letter-spacing: 2px;
        }
        .content {
            padding: 40px;
        }
        h2 {
            font-family: Georgia, serif;
            font-size: 20px;
            font-weight: normal;
            margin-top: 30px;
            margin-bottom: 20px;
            border-bottom: 1px solid #EBEBEB;
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        p {
            font-size: 15px;
            line-height: 1.6;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .items-table th {
            background-color: #F8F6F3;
            padding: 12px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            border-bottom: 2px solid #EBEBEB;
        }
        .items-table td {
            padding: 15px 12px;
            font-size: 13px;
            border-bottom: 1px solid #EBEBEB;
        }
        .badge {
            background-color: #F3EFE9;
            color: #8C8476;
            padding: 3px 8px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 5px;
        }
        .footer {
            background-color: #F8F6F3;
            padding: 20px;
            text-align: center;
            font-size: 11px;
            color: #8C8476;
            border-top: 1px solid #EBEBEB;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>DECO & CERAM</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Bonjour {{ $order->first_name }} {{ $order->last_name }},</p>
            <p>Nous avons bien reçu votre commande et nous vous en remercions. Notre équipe étudie votre commande et vous contactera dans les plus brefs délais pour le paiement.</p>

            <h2>Récapitulatif de votre commande</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Détails du Produit</th>
                        <th style="text-align: center;">Quantité (Boîtes)</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>
                                <strong style="font-size: 14px;">{{ $item->product->name ?? 'Produit' }}</strong><br>
                                <span style="font-size: 11px; color: #8C8476; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Marque : {{ $item->product->collection->brand->name ?? '-' }}
                                </span>
                                @if($item->variant_name)
                                    <br><span class="badge">{{ $item->variant_name }}</span>
                                @endif
                            </td>
                            <td style="text-align: center; font-size: 15px; font-weight: bold;">
                                {{ $item->boxes ?? '-' }}
                            </td>
                            <td style="text-align: right; font-size: 13px; line-height: 1.4;">
                                @if($item->pcs)
                                    <strong>{{ $item->pcs }}</strong> pièces<br>
                                @endif
                                @if($item->meters)
                                    <strong>{{ number_format($item->meters, 2) }}</strong> m²
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Deco & Ceram. Tous droits réservés.<br>
            Ceci est un message automatique, merci de ne pas y répondre.
        </div>
    </div>
</body>
</html>
