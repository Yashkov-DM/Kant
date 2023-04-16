<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CardController extends BaseController
{
    public function generateCard($bin) {

        $validator = Validator::make(['bin' => $bin],
            [
                'bin' => 'digits:6',
            ],
            [
                'bin.digits' => 'BIN должен состоять из 6 символов',
            ]
        );

        if ($validator->fails()) {
            return ['status' => 400, 'messages' => $validator->messages()];
        }

        DB::beginTransaction();
        try {
            $number_card = Card::where('bin_card', $bin)->orderByDesc('number_card')->limit(1)->get('number_card');
            $number_card = $number_card->isEmpty() ? '0000000001' : str_pad(++$number_card[0]->number_card, 10, '0', STR_PAD_LEFT);
            $cardRecord = Card::create(['bin_card' => $bin, 'number_card' => $number_card, 'full_number_card' => $bin . $number_card]);
            DB::commit();
        } catch(\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        dd($cardRecord);

        return [
            'status' => 200,
            'messages' => "Запрос успешно выполнен",
            'data' => $cardRecord
        ];
    }
}
