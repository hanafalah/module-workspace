<?php

namespace Hanafalah\ModuleWorkspace\Resources\Workspace;

use Illuminate\Http\Request;

class ShowWorkspace extends ViewWorkspace
{

    /**
     * Transform the resource into an array.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $arr = [
            'setting' => $this->toSettingApi()
            // 'address' => $this->relationValidation('address', function () {
            //     return $this->address->toShowApi()->resolve();
            // }),
        ];
        $arr = $this->mergeArray(parent::toArray($request), $arr);
        return $arr;
    }
}
