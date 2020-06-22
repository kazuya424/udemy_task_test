<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;

use Illuminate\Support\Facades\DB; //クエリビルダ

use App\Services\CheckFormData;

use App\Http\Requests\StoreContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //Request $requestでデータを持ってくる
    {
        $search = $request->input('search');
        //dd($request);



        //エロクワント　ORマッパー
        //$contact = ContactForm::all();

        //クエリビルダ
        // $contacts = DB::table('contact_forms')
        //     ->select('id', 'your_name', 'title', 'created_at')
        //     ->orderBy('created_at', 'asc') //順番変更
        //     ->paginate(20);
        //dd($contacts);

        //検索フォーム
        $query = DB::table('contact_forms');

        if ($search !== null) { //検索した時してくれる処理
            //全角スペースを半角に
            $search_split = mb_convert_kana($search, 's');

            //空白で区切る
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach ($search_split2 as $value) {
                $query->where('your_name', 'like', '%' . $value . '%');
            }
        };

        $query->select('id', 'your_name', 'title', 'created_at');
        $query->orderBy('created_at', 'asc'); //順番変更
        $contacts = $query->paginate(20);

        return view('contact.index', compact('contacts')); //.(ドット)の前フォルダ名　後ファイル名
        //compactはphpの関数
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactForm $request) //保存。　バリデーションファイル読み込む
    {
        $contact = new ContactForm; //インスタンス化

        $contact->your_name = $request->input('your_name'); //フォームに書いてあるyour_nameの情報を持ってこれる
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();
        return redirect('contact/index');
        //dd(your_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ファットコントローラー＝コントローラーに書く量が多いこと＝＞スリムがいい
        //
        $contact = ContactForm::find($id);

        $gender = CheckFormData::checkGender($contact); //変数を受け取る

        $age = CheckFormData::checkAge($contact);


        return view('contact.show', compact('contact', 'gender', 'age')); //.(ドット)の前フォルダ名　後ファイル名
        //compactはコンマで変数を複数渡すことができる

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = ContactForm::find($id);

        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //storeとほとんど同じ
        $contact = ContactForm::find($id); //現在存在しているidを持ってくる。 1人のデータ

        $contact->your_name = $request->input('your_name'); //フォームに書いてあるyour_nameの情報を持ってこれる
        $contact->title = $request->input('title');
        $contact->email = $request->input('email');
        $contact->url = $request->input('url');
        $contact->gender = $request->input('gender');
        $contact->age = $request->input('age');
        $contact->contact = $request->input('contact');

        $contact->save();
        return redirect('contact/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $contact = ContactForm::find($id);
        $contact->delete();

        return redirect('contact/index');
    }
}
