<?php

namespace Database\Seeders;

use App\Models\PassageStyle;
use Illuminate\Database\Seeder;

class PassageStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stylesLists = [
            [
                "

           h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }
        p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
        }
        label {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
        }





          "
            ],
            [
                "   h1 {
                        margin-bottom: 20px;
                        font-size: 22px;
                        letter-spacing: 0.28em;
                        color: #333;
                    }
                    p {
                        font-size: 18px;
                        line-height: 1.6;
                        letter-spacing: 0.28em;
                        color: #555;
                    }
                   label {
                        font-size: 18px;
                        line-height: 1.6;
                        letter-spacing: 0.28em;
                        color: #555;
                    }

                    "
            ],
            [
                "

             h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }
        p {
            font-size: 18px;
            line-height: 2.8;
            color: #555;
        }
        label {
            font-size: 18px;
            line-height: 2.8;
            color: #555;
        }
 .form-check-input{
        margin-top: 16px;
        }

        "
            ],
            [
                "
                h1 {
            margin-bottom: 20px;
            font-size: 28px;
            letter-spacing: 0.28em;
            color: #333;
        }
        p {
            font-size: 18px;
            line-height: 2.8;
            letter-spacing: 0.28em;
            color: #555;
        }
        label {
            font-size: 18px;
            line-height: 2.8;
            letter-spacing: 0.28em;
            color: #555;
        }
        .form-check-input{
        margin-top: 16px;
        }

        "

            ]
        ];


        foreach ($stylesLists as $style) {
            $passageStyles = new PassageStyle();
            $passageStyles->style = $style[0];
            $passageStyles->save();

        }

    }
}
