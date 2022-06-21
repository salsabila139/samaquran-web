@extends('dasmin.base')

@section('content')
<div class="col-sm-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Edit Data</h6>
                            <form action="{{route('update', $quote->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="sumber" class="form-label">Sumber</label>
                                    <input value="{{$quote->sumber}}" type="text" class="form-control" id="sumber" name="sumber">
                                </div>
                                <div class="mb-3">
                                    <label for="kutipan" class="form-label">Kutipan</label>
                                    <textarea class="form-control" id="kutipan" name="kutipan" rows="4">{{$quote->kutipan}}</textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
@stop