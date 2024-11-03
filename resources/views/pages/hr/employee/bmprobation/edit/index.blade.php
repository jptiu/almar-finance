<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <div class="relative">
            <h1 class="text-2xl md:text-2xl text-slate-800 dark:text-slate-100 font-bold mb-12">Edit BM Probation</h1>
        </div>

        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <form action="{{ route('bmprobation.update', $prob->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                    <div class="grid grid-cols-3 gap-12">
                            <div class="...">
                                <div class="mb-8">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                <div class="md:col-span-1">
                                                    <label for="payment_method">Employee Name</label>
                                                    <input type="text" name="payment_method" id="payment_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value="{{$prob->employee->f_name.' '.$prob->employee->l_name}}" placeholder="" />
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="...">
                                <div class="mb-8">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                <div class="md:col-span-1">
                                                    <label for="status">Probation Status</label>
                                                    <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                                        <option value="Probation" {{$prob->status == 'Probation'?'selected':''}}>Probation</option>
                                                        <option value="Regular" {{$prob->status == 'Regular'?'selected':''}}>Regular</option>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>

                    <div class="grid grid-cols-3 gap-12 mt-8">
                            <div class="...">
                                <div class="mb-8">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-2">
                                                <div class="md:col-span-1">
                                                    <label for="date_start">Start of Probation</label>
                                                    <input type="date" name="date_start" id="date_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value="" placeholder="" />
                                                </div>
                                                <div class="md:col-span-1">
                                                    <label for="date_end">End of Probation</label>
                                                    <input type="date" name="date_end" id="date_end" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" value="" placeholder="" />
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-8">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                <div class="md:col-span-1">
                                                    <label for="type">Monthly/Daily</label>
                                                    <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                                        <option value="Monthly" {{$prob->type == 'Monthly'?'selected':''}}>Monthly</option>
                                                        <option value="Daily" {{$prob->type == 'Daily'?'selected':''}}>Daily</option>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="...">
                                <div class="mb-8">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                <div class="md:col-span-1">
                                                    <label for="quota">Quota</label>
                                                    <select name="quota" id="quota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                                        <option value="Inc. 100 customers, 500k release">Inc. 100 customers, 500k release</option>
                                                        <option value="Inc. Daily to 30k">Inc. Daily to 30k</option>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="...">
                                <div class="mb-8">
                                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                                        <div class="lg:col-span-2">
                                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">
                                                <div class="md:col-span-1">
                                                    <label for="branch">Branch/Department</label>
                                                    <select name="branch" id="branch" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-2 p-2.5" />
                                                        <option value="Gingoog" {{$prob->branch == 'Gingoog'?'selected':''}}>Gingoog</option>
                                                        <option value="Lapu-Lapu-1" {{$prob->branch == 'Lapu-Lapu-1'?'selected':''}}>Lapu-Lapu-1</option>
                                                        <option value="Matina Davao" {{$prob->branch == 'Matina Davao'?'selected':''}}>Matina Davao</option>
                                                        <option value="CDO" {{$prob->branch == 'CDO'?'selected':''}}>CDO</option>
                                                        <option value="Oroquieta" {{$prob->branch == 'Oroquieta'?'selected':''}}>Oroquieta</option>
                                                    </select>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>

                    <div>
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-1">
                            <div class="lg:col-span-2">
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1">                    
                                    <div class="md:col-span-1">
                                        <div class="inline-flex items-start" style="float: right;">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-app-layout>