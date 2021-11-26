<?php
 /* 
 * <instituição: União Metropolitana de Educação e Cultura(UNIME), Lauro de Freitas>
 * <curso: Bacharelado em sistemas da informação>
 * <disciplina: programação web II>
 * <Professor: Pablo Ricardo Roxo Silva>
 * <Alunos: Matheus Avelar Almeida Santana, Samorano Silva.>
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{

    public function index(Request $request)
    {   
        //valor da pesquisa
        $search = $request->search;
        $value = $request->value;

        //ordenação da pesquisa
        $order_by = $request->order_by;
        $order = $request->order === 'desc'
        ?'desc'
        :'asc';
        
        $colunas = ['nome', 'genero', 'desenvolvedor', 'distribuidor', 'metacritic'];
        
        $test = TestModel::select(['*'])

        ->when($search && in_array($search,$colunas) && $value, function($query) use($search, $value){

            $query->where($search, 'like', '%'. $value.'%');
        })
        ->when($search && in_array($order_by, $colunas), function($query) use($order_by, $order){

            $query->orderBy($order_by, $order);

        })

        ->get();

        //filtros
        //mostra todo o bd// GET

        //$test = TestModel::all();
        //SELECT * FROM jogos
        return response()->json($test);

    }
    public function show($id)
    {
        //mostra iten especifico do bd// GET

        $test = TestModel::findOrFail($id);
        //SELECT * FROM jogos WHERE id = $id
        //findOrFail() ja tras o erro 404
        return response()->json($test);

    }
    public function store(Request $request)
    {
        //add iten ao bd// POST

        $dados = $request->all();

        $validator = Validator::make($dados, (new StoreTestRequest())->rules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
           
        }
        
        $test = TestModel::create($dados);
        //INSERT INTO jogos (Nome, Genero) VALUES ('$dados->Nome', '$dados->Genero')
        //dd($dados);
        return response()->json($test, 201);

    }
    public function update(Request $request, $id)
    {
        //atualiza um item do bd// PUT

        $dados = $request->all();

        $validator = Validator::make($dados, (new UpdateTestRequest())->rules());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
           
        }

        $test = TestModel::findOrFail($id)->update($dados);
        //UPDATE jogos SET Nome = '$request->Nome', Genero = '$request->Genero' WHERE id = $id
        //return response()->json($test);
        return $this->show($id);

    }
    public function destroy($id)
    {
        //deleta um item do bd// DELETE

        TestModel::findOrFail($id)->delete();
        //DELETE FROM jogos WHERE id = $id
        return response()->json(['Apagando o jogo' . $id, 204]);

    }
    


}

