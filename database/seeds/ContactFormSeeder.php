<?php

use Illuminate\Database\Seeder;

use App\Models\ContactForm;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //インポートしてるか常に確認すること　ContactForm
        factory(ContactForm::class, 200)->create(); //200個のダミーデータ
    }
}
