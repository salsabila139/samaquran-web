@extends('dasmin.base')

@section('content')
<div class="col-sm-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Create Data</h6>
                            <form action="{{route('store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="sumber" class="form-label">Sumber</label>
                                    <input type="text" class="form-control" id="sumber" name="sumber">
                                </div>
                                <div class="mb-3">
                                    <label for="kutipan" class="form-label">Kutipan</label>
                                    <textarea class="form-control" id="kutipan" name="kutipan" rows="4"></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
@stop