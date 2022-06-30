<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class CallbackController extends Controller
{
    // Isi dengan private key anda
    protected $privateKey = 'UjvNQ-qZC9C-cyZiF-Rotg9-rEPgM';

    // public function handle(Request $request)
    // {
    //     $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
    //     $json = $request->getContent();
    //     $signature = hash_hmac('sha256', $json, $this->privateKey);

    //     if ($signature !== $callbackSignature) {
    //         return 'Invalid signature';
    //     }

    //     if ('payment_status' !== $request->server('HTTP_X_CALLBACK_EVENT')) {
    //         return 'Invalid callback event, no action was taken';
    //     }

    //     $data = json_decode($json);
    //     $uniqueRef = $data->reference;
    //     $status = strtoupper($data->status);

    //     /*
    //     |--------------------------------------------------------------------------
    //     | Proses callback untuk closed payment
    //     |--------------------------------------------------------------------------
    //     */
    //     if (1 === (int) $data->is_closed_payment) {
    //         $transaksi = Transaksi::where('reference', $uniqueRef)->first();

    //         if (! $transaksi) {
    //             return 'No invoice found for this unique ref: ' . $uniqueRef;
    //         }

    //         $transaksi->update(['status' => $status]);
    //         return response()->json(['success' => true]);
    //     }


    //     /*
    //     |--------------------------------------------------------------------------
    //     | Proses callback untuk open payment
    //     |--------------------------------------------------------------------------
    //     */
    //     $transaksi = Transaksi::where('reference', $uniqueRef)
    //         ->where('status', 'UNPAID')
    //         ->first();

    //     if (! $transaksi) {
    //         return 'Invoice not found or current status is not UNPAID';
    //     }

    //     if ((int) $data->total_amount !== (int) $transaksi->total_amount) {
    //         return 'Invalid amount, Expected: ' . $transaksi->total_amount . ' - Received: ' . $data->total_amount;
    //     }

    //     switch ($data->status) {
    //         case 'PAID':
    //             $transaksi->update(['status' => 'PAID']);
    //             return response()->json(['success' => true]);

    //         case 'EXPIRED':
    //             $transaksi->update(['status' => 'UNPAID']);
    //             return response()->json(['success' => true]);

    //         case 'FAILED':
    //             $transaksi->update(['status' => 'UNPAID']);
    //             return response()->json(['success' => true]);

    //         default:
    //             return response()->json(['error' => 'Unrecognized payment status']);
    //     }
    // }

    public function handle(Request $request)
    {
        // ambil callback signature
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE') ?? '';

        // ambil data JSON
        $json = $request->getContent();

        // generate signature untuk dicocokkan dengan X-Callback-Signature
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        // validasi signature
        if ($callbackSignature !== $signature) {
            return "Invalid Signature"; // signature tidak valid, hentikan proses
        }

        $data = json_decode($json);
        $event = $request->server('HTTP_X_CALLBACK_EVENT');

        if ($event == 'payment_status') {
            $reference = $data->reference;


            // pembayaran sukses, lanjutkan proses sesuai sistem Anda, contoh:
            $order = Transaksi::where('reference', $reference)
                ->where('status', 'UNPAID')->first();


            if (!$order) {
                return "Order not found or current status is not UNPAID";
            }

            // Lakukan validasi nominal
            if ($data->total_amount !== $order->amount) {
                return "Invalid amount";
            }

            if ($data->status == 'PAID') // handle status PAID
            {
                $order->update([
                    'status'    => 'PAID'
                ]);
                return response()->json([
                    'success' => true
                ]);
            } elseif ($data->status == 'EXPIRED') // handle status EXPIRED
            {
                $order->update([
                    'status'    => 'CANCELED'
                ]);

                return response()->json([
                    'success' => true
                ]);
            } elseif ($data->status == 'FAILED') // handle status FAILED
            {
                $order->update([
                    'status'    => 'CANCELED'
                ]);

                return response()->json([
                    'success' => true
                ]);
            }
        }

        return "No action was taken";
    }
}
