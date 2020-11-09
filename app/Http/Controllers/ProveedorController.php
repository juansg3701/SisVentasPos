<?php
namespace sisVentas\Http\Controllers;
use Illuminate\Http\Request;
use sisVentas\Http\Requests;
use sisVentas\Proveedor;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ProveedorFormRequest;
use DB;

class ProveedorController extends Controller
{
	//Constructor
	public function __construct(){
		$this->middleware('auth');	
	} 

	//Función de inicial, retorna vista al módulo principal de proveedores
	public function index(Request $request){
		if ($request) {
			//Definición de variables de consulta para traer el contenido correspondiente de la vista
			$query0=trim($request->get('searchText0'));
	 		$query1=trim($request->get('searchText1'));
	 		//Llamado a la tabla proveedor en la BD, filtrando de acuerdo las variables de consulta y ordenando
	 		$proveedores=DB::table('proveedor')
	 		->where('nombre_empresa','LIKE', $query0.'%')
	 		->where('documento','LIKE', '%'.$query1.'%')
	 		->orderBy('id_proveedor', 'desc')
	 		->paginate(10);
	 		//LLamado a la tabla proveedor de la BD
	 		$proveedoresP=DB::table('proveedor')
	 		->orderBy('id_proveedor', 'desc')->get();
	 		//Método y módulos para filtrar el acceso de acuerdo a la cuenta de usuario en uso.
	 		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 		$modulos=DB::table('cargo_modulo')
	 		->where('id_cargo','=',$cargoUsuario)
	 		->orderBy('id_cargo', 'desc')->get();

	 		return view('almacen.proveedor.index',["proveedores"=>$proveedores,"searchText0"=>$query0,"searchText1"=>$query1, "modulos"=>$modulos,"proveedoresP"=>$proveedoresP]);
	 	}
	}

	// Función que retorna una vista al registro de proveeedores
	public function create(Request $request){
		$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
		$modulos=DB::table('cargo_modulo')
	 	->where('id_cargo','=',$cargoUsuario)
	 	->orderBy('id_cargo', 'desc')->get();
	 	return view('almacen.proveedor.registrar', ["modulos"=>$modulos]);
	}

	// Función para registrar datos del formulario de registro de proveeedores a la BD
	public function store(ProveedorFormRequest $request){
	 	$documentoR=$request->get('documento');
	 	$correoR=$request->get('correo');

	 	//Llamado a la tabla proveedor para comparar los datos ingresados con los existentes en la BD
		$DocumenRegis=DB::table('proveedor')
		->where('documento','=',$documentoR)
		->orderBy('id_proveedor','desc')->get();
	 	$CorreoRegis=DB::table('proveedor')
	 	->where('correo','=',$correoR)
	 	->orderBy('id_proveedor','desc')->get();

	 	//Validar si el correo y/o documento ingresado existe en los registros en la BD.
	 	if(count($DocumenRegis)==0){
	 		if(count($CorreoRegis)==0){
	 			//Registrar los datos en la BD de acuerdo al formulario de registro
	 			$proveedor = new Proveedor;
				$proveedor->nombre_empresa=$request->get('nombre_empresa');
				$proveedor->nombre_proveedor=$request->get('nombre_proveedor');
				$proveedor->direccion=$request->get('direccion');
				$proveedor->telefono=$request->get('telefono');
				$proveedor->correo=$correoR;
				$proveedor->documento=$documentoR;
				$proveedor->verificacion_nit=$request->get('verificacion_nit');
				$proveedor->save();
				return back()->with('msj','Proveedor guardado');
	 		}else{
	 			return back()->with('errormsj','Correo ya registrado!');
	 		}
	 	}else{
	 		return back()->with('errormsj','¡Documento ya registrado!');
	 	}		
	}

	//Función para hacer la descarga xls de proveedor
	public function show($id){
		return view('almacen.descargaExcel.descargarProveedor');
	}

	// Función que retorna una vista al formulario de edición de proveeedores
	public function edit($id){
	 	$cargoUsuario=auth()->user()->tipo_cargo_id_cargo;
	 	$modulos=DB::table('cargo_modulo')
	 	->where('id_cargo','=',$cargoUsuario)
	 	->orderBy('id_cargo', 'desc')->get();			
	 	return view("almacen.proveedor.edit",["proveedor"=>Proveedor::findOrFail($id), "modulos"=>$modulos]);
	}

	//Función para actualizar los datos en la BD que han sido editados en el formulario de edición de proveedores
	public function update(ProveedorFormRequest $request, $id){
	 	$id=$id;
	 	$documentoR=$request->get('documento');
	 	$correoR=$request->get('correo');

	 	//Llamado a la tabla proveedor para comparar los datos ingresados con los existentes en la BD
	 	$DocumenRegis=DB::table('proveedor')
	 	->where('id_proveedor','!=',$id)
	 	->where('documento','=',$documentoR)
	 	->orderBy('id_proveedor','desc')->get();
	 	$CorreoRegis=DB::table('proveedor')
	 	->where('id_proveedor','!=',$id)
	 	->where('correo','=',$correoR)
	 	->orderBy('id_proveedor','desc')->get();

	 	//Validar si el correo y/o documento ingresado existe en los registros en la BD.
	 	if(count($DocumenRegis)==0){
	 		if(count($CorreoRegis)==0){
	 			//Actualizar los datos en la BD de acuerdo al formulario de edición y el regitro especificado
	 			$proveedor = Proveedor::findOrFail($id);
				$proveedor->nombre_empresa=$request->get('nombre_empresa');
				$proveedor->nombre_proveedor=$request->get('nombre_proveedor');
				$proveedor->direccion=$request->get('direccion');
				$proveedor->telefono=$request->get('telefono');
				$proveedor->correo=$correoR;
				$proveedor->documento=$documentoR;
				$proveedor->verificacion_nit=$request->get('verificacion_nit');
				$proveedor->update();
				 return back()->with('msj','Proveedor actualizado');
	 		}else{
	 			return back()->with('errormsj','Correo ya registrado!');
	 		}
	 		
	 	}else{
	 		return back()->with('errormsj','¡Documento ya registrado!');
	 	}
	}

	//Función para eliminar el registro especificado en el módulo de proveedores
	public function destroy($id){
	 	$id=$id;
	 	//Llamado a la tabla stock en la BD, filtrado de acuerdo al registro especificado
	 	$existe=DB::table('stock')
	 	->where('proveedor_id_proveedor','=',$id)
	 	->orderBy('id_stock', 'desc')->get();
	 	//Validar si el registro especificado tiene relación en stock
	 	if(count($existe)==0){
	 		$proveedor=Proveedor::findOrFail($id);
	 		$proveedor->delete();
	 		return back()->with('msj','Proveedor eliminado');
	 	}else{
	 		return back()->with('errormsj','¡Proveedor relacionado con stock!');
	 	}	 		
	}

}
