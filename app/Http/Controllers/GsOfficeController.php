<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\GsOfficeRequest;
use App\Http\Resources\GsOfficeResource;
use App\Models\GsOffice;
use App\Repositories\Contracts\GsOfficeRepositoryInterface;
use Illuminate\Http\Request;

class GsOfficeController extends Controller
{
    private $gsOfficeRepository;

    public function __construct(GsOfficeRepositoryInterface $gsOfficeRepository)
    {
        $this->gsOfficeRepository = $gsOfficeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_gs_offices');
        return ResponseHelper::findSuccess("list", GsOfficeResource::collection($this->gsOfficeRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GsOfficeRequest $request)
    {
        $this->authorize('store_gs_office');
        return ResponseHelper::createSuccess("gsOffice", new GsOfficeResource($this->gsOfficeRepository->store($request->validated())));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GsOffice  $gsOffice
     * @return \Illuminate\Http\Response
     */
    public function show(GsOffice $gsOffice)
    {
        $this->authorize('show_gs_office');
        $gsOffice->load('gsActing' , 'gsPermanent');
        return ResponseHelper::findSuccess("gsOffice", new GsOfficeResource($gsOffice));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GsOffice  $gsOffice
     * @return \Illuminate\Http\Response
     */
    public function update(GsOfficeRequest $request, GsOffice $gsOffice)
    {
        $this->authorize('update_gs_office');
        return ResponseHelper::updateSuccess("gsOffice", new GsOfficeResource($this->gsOfficeRepository->update($gsOffice->id, $request->validated())));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GsOffice  $gsOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy(GsOffice $gsOffice)
    {
        $this->authorize('destroy_gs_office');
        return ResponseHelper::deleteSuccess("gsOffice", $this->gsOfficeRepository->delete($gsOffice->id));
    }
}
