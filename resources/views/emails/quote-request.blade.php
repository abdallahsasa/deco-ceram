<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Quote Request</title>
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
        .header img {
            max-height: 50px;
            width: auto;
        }
        .content {
            padding: 40px;
        }
        h2 {
            font-family: Georgia, serif;
            font-size: 24px;
            font-weight: normal;
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #EBEBEB;
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table td {
            padding: 10px 0;
            border-bottom: 1px solid #FAFAFA;
            font-size: 14px;
        }
        .details-table td.label {
            font-weight: bold;
            color: #8C8476;
            width: 30%;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
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
        .footer {
            background-color: #F8F6F3;
            padding: 20px;
            text-align: center;
            font-size: 11px;
            color: #8C8476;
            border-top: 1px solid #EBEBEB;
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="color: #FFFFFF; font-family: Georgia, serif; font-size: 24px; margin: 0; letter-spacing: 2px;">DECO & CERAM</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Customer Details</h2>
            <table class="details-table">
                <tr>
                    <td class="label">Name</td>
                    <td>{{ $quoteRequest->first_name }} {{ $quoteRequest->last_name }}</td>
                </tr>
                <tr>
                    <td class="label">Email</td>
                    <td><a href="mailto:{{ $quoteRequest->email }}" style="color: #8C8476; text-decoration: none;">{{ $quoteRequest->email }}</a></td>
                </tr>
                @if($quoteRequest->phone)
                <tr>
                    <td class="label">Phone</td>
                    <td>{{ $quoteRequest->phone }}</td>
                </tr>
                @endif
                @if($quoteRequest->company)
                <tr>
                    <td class="label">Company</td>
                    <td>{{ $quoteRequest->company }}</td>
                </tr>
                @endif
                @if($quoteRequest->project_type)
                <tr>
                    <td class="label">Project Type</td>
                    <td>{{ $quoteRequest->project_type }}</td>
                </tr>
                @endif
                @if($quoteRequest->message)
                <tr>
                    <td class="label">Message</td>
                    <td style="white-space: pre-line; line-height: 1.5;">{{ $quoteRequest->message }}</td>
                </tr>
                @endif
            </table>

            <h2>Requested Products</h2>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Packaging Specs</th>
                        <th style="text-align: center;">Qty (Boxes)</th>
                        <th style="text-align: right;">Total Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quoteRequest->items as $item)
                        <tr>
                            <td>
                                <strong style="font-size: 14px;">{{ $item->product->name ?? 'Unknown Product' }}</strong><br>
                                <span style="font-size: 11px; color: #8C8476; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Brand: {{ $item->product->collection->brand->name ?? '-' }}
                                </span>
                                @if($item->variant_name)
                                    <br><span class="badge">{{ $item->variant_name }}</span>
                                @endif
                            </td>
                            <td style="color: #8C8476; font-size: 12px;">
                                @if($item->pcs_per_box)
                                    {{ $item->pcs_per_box }} pcs/box<br>
                                @endif
                                @if($item->sqm_per_box)
                                    {{ number_format($item->sqm_per_box, 2) }} m²/box
                                @endif
                            </td>
                            <td style="text-align: center; font-size: 15px; font-weight: bold;">
                                {{ $item->boxes ?? '-' }}
                            </td>
                            <td style="text-align: right; font-size: 13px; line-height: 1.4;">
                                @if($item->pcs)
                                    <strong>{{ $item->pcs }}</strong> pcs<br>
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
            &copy; {{ date('Y') }} Deco & Ceram. All rights reserved.<br>
            Sent automatically from Deco & Ceram Platform.
        </div>
    </div>
</body>
</html>
