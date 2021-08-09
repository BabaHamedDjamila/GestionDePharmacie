<?php

namespace App\Http\Controllers;
use App\Produits;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
      /**
  * Display a listing of the resource.
  * @param int $Id
  * @return \Illuminate\Http\Response
  */
   /* public function index()
    {
        $Pub = Publications::all();
        return view('publicationDossier.show', compact('Pub'));
    }*/
    public function index()
	{
		$Prod = Produits::latest()->paginate(4);
		return view('ProduitFiles.index2',compact('Prod'))->with('i', (request()->input('page', 1) - 1) * 4);
	}
     /**
     * Display the specified resource.
     *
     * @param int $id
     * @param  \App\Produits $Prod
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        $Pub = Publications::find($id);
        return view('publicationDossier.show')->with('Pub',$Pub);     
    }*/
    public function show(Produits $Prod)
	{
		return view('ProduitFiles.index2',compact('Prod'));
    }

    
    /**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/

	public function create()
	{
		return view('ProduitFiles.create');
	}
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @param \Illuminate\Http\Request $request
	
     */
    public function store(Request $request)
	{

		$req=$request->validate([
		'id' => 'required',
		'Titre' => 'required',
        'Contenue' => 'required',
        'Catégories' => 'required',
        'Lien' => 'required',
        'Images' => 'required',
        'Videos' => 'required',
        'Date' => 'required',
		]);

		$ProdId = $request->pub_id;
        Produits::updateOrCreate(['id' => $ProdId],['Titre' => $request->Titre, 
        'Contenue' => $request->Contenue,'Catégories'=>$request->Catégories
        ,'Lien'=>$request->Lien
        ,'Images'=>$request->Images
        ,'Videos'=>$request->Videos
        ,'Date'=>$request->Date]);
		if(empty($request->pub_id))
			$msg = 'Customer entry created successfully.';
		else
			$msg = 'Customer data is updated successfully';
            return back();
        //    return redirect()->route('publicationDossier.index2')->with('success',$msg);
    }
   
   /* public function edit($id)
    {
        $Pub = Publications::find($id);
     
        $Pub = Publications::find($id);
      return view('publicationDossier.view')->with('Pub',$Pub);    
      

        return view('publicationDossier.edit')->with('Pub', $Pub);
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
         /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
	{
		$where = array('id' => $id);
		$Prod = Produits::where($where)->first();
		return Response::json($Prod);
	}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $Prod = Produits::findOrFail($request->Produit_id);

        $Prod->update($request->all());
       
        return back();
    }
	/*	$Pub = Publications::find($id);
         // Handle File Upload
        if($request->hasFile('Images')){
            // Get filename with the extension
            $filenameWithExt = $request->file('Images')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('Images')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('Images')->storeAs('public/Images', $fileNameToStore);
            // Delete file if exists
            Storage::delete('public/Images/'.$Pub->Images);
		
	   //Make thumbnails 
	    $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('Images')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/ImagesFiles/'.$thumbStore);
        }*/
        // Update Post
      
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function destroy($id)
    {
      Publications::find($id)->delete();
      return back()->with('success','Publication supprimé ');;  
    //  return redirect()->route('publicationDossier.index2')->with('success','Publication supprimé ');
    }*/
    public function destroy($id)
	{
		$Prodl = Produits::where('id',$id)->delete();
		return Response::json($Prodl);
	}
}
