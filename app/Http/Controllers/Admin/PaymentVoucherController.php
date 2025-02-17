<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentVoucherMassDestroyRequest;
use App\Http\Requests\PaymentVoucherStoreRequest;
use App\Http\Requests\PaymentVoucherUpdateRequest;
use App\PaymentVoucher;
use App\PaymentVoucherDetails;
use Illuminate\Http\Request;

class PaymentVoucherController extends Controller
{
    public function index()
    {
        access();

        $where = [];
        $where[] = ['status', '=', 'Payment_Voucher'];

        $payment_vouchers = PaymentVoucher::where($where)->whereIn('office_id', acl())->orderBy('id', 'desc')->get();

        return view('admin.payment_voucher.index', compact('payment_vouchers'));
    }

    public function create()
    {
        create();

        return view('admin.payment_voucher.create');
    }

    public function store(PaymentVoucherStoreRequest $request)
    {
        $except = ['update_id',
            'ledger_group_id',
            'ledger_subgroup_id',
            'expenditure_sector_id',
            'total_amount',
            'total_receive',
            'total_dues',
            'bdt_current_receive',
            'sar_current_receive',
            'myr_current_receive',
            'inr_current_receive',
            'qar_current_receive',
        ];
        $input = $request->except($except);
        $date = $request->date;
        $input['date'] = date('Y-m-d', strtotime($date));
        // return $input;
        $update_id = $request->update_id;
        $voucher_details_ids = $request->voucher_details_id;
        $expenditure_sector_ids = $request->expenditure_sector_id;
        $ledger_subgroup_ids = $request->ledger_subgroup_id;
        $ledger_subgroup_ids = $request->ledger_subgroup_id;
        $ledger_group_ids = $request->ledger_group_id;
        $ledger_subgroup_ids = $request->ledger_subgroup_id;
        $bdt_current_receives = $request->bdt_current_receive;
        $input['bdt_current_receive'] = array_sum($bdt_current_receives);
        $sar_current_receives = $request->sar_current_receive;
        $input['sar_current_receive'] = array_sum($sar_current_receives);
        $myr_current_receives = $request->myr_current_receive;
        $input['myr_current_receive'] = array_sum($myr_current_receives);
        $inr_current_receives = $request->inr_current_receive;
        $input['inr_current_receive'] = array_sum($inr_current_receives);
        $qar_current_receives = $request->qar_current_receive;
        $input['qar_current_receive'] = array_sum($qar_current_receives);
        $input['status'] = 'Payment_Voucher';

        if ($update_id == 0) {
            $prefix = date('Y');
            $max = PaymentVoucher::where('prefix', $prefix)->max('serial');
            $serial = isset($max) ? ($max + 1) : 1;
            $input['prefix'] = $prefix;
            $input['serial'] = $serial;
            $receiveVoucher = PaymentVoucher::create($input);
            if (isset($receiveVoucher)) {
                foreach ($expenditure_sector_ids as $key => $value) {
                    $voucher_details_id = $voucher_details_ids[$key];
                    $data = array(
                        'status' => 'Payment_Voucher',
                        'voucher_id' => $receiveVoucher->id,
                        'date' => $input['date'],
                        'region_type_id' => $input['region_type_id'],
                        'office_id' => $input['office_id'],
                        'bank_id' => isset($input['bank_id']) ? $input['bank_id'] : null,
                        'account_id' => isset($input['account_id']) ? $input['account_id'] : null,
                        'account_type' => $input['account_type'],
                        'passenger_id' => $input['passenger_id'],
                        'expenditure_sector_id' => $value,
                        'ledger_group_id' => isset($ledger_group_ids) ? $ledger_group_ids[$key] : null,
                        'ledger_subgroup_id' => isset($ledger_subgroup_ids) ? $ledger_subgroup_ids[$key] : null,
                        'bdt_current_receive' => $bdt_current_receives[$key],
                        'sar_current_receive' => $sar_current_receives[$key],
                        'myr_current_receive' => $myr_current_receives[$key],
                        'inr_current_receive' => $inr_current_receives[$key],
                        'qar_current_receive' => $qar_current_receives[$key],
                    );
                    if ($voucher_details_id <= 0) {
                        PaymentVoucherDetails::create($data);
                    } else {
                        PaymentVoucherDetails::where('id', $voucher_details_id)->update($data);
                    }
                }
            }
            $message = 'success_' . trans('cruds.insert_message');
            return redirect()->route('admin.payment_voucher.show', $receiveVoucher->id)->with("message", $message);
        } else {
            $payment_voucher = PaymentVoucher::where('id', $update_id)->first();
            if ($payment_voucher->update($input)) {
                foreach ($expenditure_sector_ids as $key => $value) {
                    $voucher_details_id = $voucher_details_ids[$key];
                    $data = array(
                        'voucher_id' => $update_id,
                        'date' => $input['date'],
                        'region_type_id' => $input['region_type_id'],
                        'office_id' => $input['office_id'],
                        'bank_id' => isset($input['bank_id']) ? $input['bank_id'] : null,
                        'account_id' => isset($input['account_id']) ? $input['account_id'] : null,
                        'account_type' => $input['account_type'],
                        'passenger_id' => $input['passenger_id'],
                        'expenditure_sector_id' => $value,
                        'ledger_group_id' => isset($ledger_group_ids) ? $ledger_group_ids[$key] : null,
                        'ledger_subgroup_id' => isset($ledger_subgroup_ids) ? $ledger_subgroup_ids[$key] : null,
                        'bdt_current_receive' => $bdt_current_receives[$key],
                        'sar_current_receive' => $sar_current_receives[$key],
                        'myr_current_receive' => $myr_current_receives[$key],
                        'inr_current_receive' => $inr_current_receives[$key],
                        'qar_current_receive' => $qar_current_receives[$key],
                    );
                    if ($voucher_details_id <= 0) {
                        PaymentVoucherDetails::create($data);
                    } else {
                        PaymentVoucherDetails::where('id', $voucher_details_id)->update($data);
                    }
                }
            }
            $message = 'success_' . trans('cruds.update_message');
            return redirect()->route('admin.payment_voucher.show', $update_id)->with("message", $message);
        }
        return redirect()->route('admin.payment_voucher.index')->with("message", $message);

    }

    public function edit(PaymentVoucher $payment_voucher)
    {
        edit();

/*         $passengers = Passenger::all();

$passenger_id = $payment_voucher->passenger_id;

$selected = "";
$passenger_options = '<option value=""></option>';
foreach ($passengers as $key => $value) {
if ($value->id == $passenger_id) {
$selected = 'selected';
} else {
$selected = '';
}
$ID = $value->prefix . PAD($value->serial);
$passenger_options .= "<option $selected value='$value->id'> $ID - $value->first_name</option>";
} */

        $payment_voucher->load(['voucherDetails']);

        return view('admin.payment_voucher.create', compact('payment_voucher'));
    }

    public function update(PaymentVoucherUpdateRequest $request, PaymentVoucher $payment_voucher)
    {
        $payment_voucher->update($request->all());

        return redirect()->route('admin.payment_voucher.index');
    }

    public function show(PaymentVoucher $payment_voucher)
    {
        show();

        $receive_no = $payment_voucher->prefix . PAD($payment_voucher->serial);

        $slug = slug();

        $current_receive = $slug . '_current_receive';

        $payment_voucher->receive_no = $receive_no;

        $payment_voucher->current_receive = $payment_voucher->$current_receive;

        $transaction_type = "";

        if ($payment_voucher->transaction_type == 'Cr') {
            $transaction_type = "Received From";
        } elseif ($payment_voucher->transaction_type == 'Dr') {
            $transaction_type = "Payment To";
        }
        $payment_voucher->transaction_type = $transaction_type;

        return view('admin.payment_voucher.show', compact('payment_voucher'));
    }

    public function destroy(PaymentVoucher $payment_voucher)
    {
        delete();

        if ($payment_voucher->delete()) {
            PaymentVoucherDetails::where('voucher_id', $payment_voucher->id)->delete();
        }
        $message = 'danger_' . trans('cruds.delete_message');

        return back()->with('message', $message);
    }

    public function massDestroy(PaymentVoucherMassDestroyRequest $request)
    {

        PaymentVoucher::whereIn('id', request('ids'))->delete();

        //return response(null, Response::HTTP_NO_CONTENT);

        $message = 'danger_' . trans('cruds.delete_message');

        return back()->with('message', $message);
    }
    public function passenger_transaction()
    {
        $where = request()->where;
        $voucher_id = $where[1][2];
        array_pop($where);
        $model = request()->model;
        $page = request()->page;

        $payment_voucher = PaymentVoucher::where('id', $voucher_id)->first();
        if (isset($payment_voucher)) {
            $payment_voucher->load(['voucherDetails']);
        }
        $data['payment_voucher'] = $payment_voucher;
        $data['value'] = find($model, $where, 'id', 'asc', 'first', array('transactions'));
        $response = view($page, $data)->render();
        return $response;
    }
    public function getBalance()
    {
        $slug = slug();
        $where = request()->where;
        $model = request()->model;
        $field = $slug . "_current_receive";
        $model = 'App\\' . $model;
        $result = $model::where($where)->sum($field);
        return response()->json($result);
    }
}
