<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{

    private static function processData($message, $data)
    {
        $responseData = ["message" => $message, "data" => $data];
        if ($data && is_object($data) && $data->resource && $data->resource instanceof LengthAwarePaginator) {
            $responseData["meta"] = [
                "itemsLength" => $data->resource->total(),
                "page" => $data->resource->currentPage(),
                "pageCount" => $data->resource->lastPage(),
                "itemsPerPage" => (int)$data->resource->perPage(),
                "pageStart" => $data->resource->firstItem(),
                "pageStop" => $data->resource->lastItem()
            ];
        }
        return $responseData;
    }

    /**
     * Response Message After Successfully Executing The Action
     * 
     * @param string $message
     * @param array $data
     * @return JsonResponse response
     */
    public static function success($message, $data)
    {
        return response()->json(ResponseHelper::processData(trans($message), $data), Response::HTTP_OK);
    }

    /**
     * Response Message After Fails The Execution Of The Action
     * 
     * @param string $message
     * @param array $data
     * @return JsonResponse response
     */
    public static function error($message, $data)
    {
        return response()->json(ResponseHelper::processData(trans($message), $data), Response::HTTP_BAD_REQUEST);
    }

    /**
     * Response Message After Successfully Creating A New Item In The Database
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function createSuccess($item, $data)
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.createSuccess', ['item' => trans('app.entities.' . $item)]), $data), Response::HTTP_CREATED);
    }

    /**
     * Response Message When Validation Error Occured
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function validationFail($item, $data)
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.dataValidationFailed', ['item' => trans('app.entities.' . $item)]), $data), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Response Message When Successfully Updated The Item In The Database
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function updateSuccess($item, $data)
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.updateSuccess', ['item' => trans('app.entities.' . $item)]), $data), Response::HTTP_OK);
    }

    /**
     * Response Message When Successfully Deleted The Item In The Database
     * 
     * @param string $item
     * @return JsonResponse response
     */
    public static function deleteSuccess($item)
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.deleteSuccess', ['item' => trans('app.entities.' . $item)]), null), Response::HTTP_OK);
    }

    /**
     * Response Message When Successfully Find The Item In The Database
     * 
     * @param string $item
     * @param array $data
     * @return JsonResponse response
     */
    public static function findSuccess($item, $data)
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.foundSuccess', ['item' => trans('app.entities.' . $item)]), $data), Response::HTTP_OK);
    }

    /**
     * Response Message When Failed To Find The Item In The Database Or Requested Page
     * 
     * @param string $item
     * @return JsonResponse response
     */
    public static function findFail($item)
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.canNotBeFound', ['item' => trans('app.entities.' . $item)]), null), Response::HTTP_NOT_FOUND);
    }

    /**
     * Response Message When Server Error
     * 
     * @return JsonResponse response
     */
    public static function networkFail()
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.serverError'), null), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Response Message When unauthenticated Request
     * 
     * @return JsonResponse response
     */
    public static function unauthenticated()
    {
        return response()->json(ResponseHelper::processData(trans('app.responses.loginRequired'), null), Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Response Message When unauthorized Request
     * 
     * @return JsonResponse response
     */
    public static function unauthorized()
    {  
        return response()->json(ResponseHelper::processData(trans('app.responses.forbidden'), null), Response::HTTP_FORBIDDEN);
    }
}