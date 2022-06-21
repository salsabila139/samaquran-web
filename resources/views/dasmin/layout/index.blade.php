@extends('dasmin.base')

@section('content')
<div class="col-sm-12">
                        <div class="bg-light rounded h-100 p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Data</h6>
                                <a href="{{route('create')}}">Tambah Data</a>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">Kutipan</th>
                                        <th scope="col">Sumber</th>
                                        <th scope="col">button</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($quotes as $quote)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{$quote->kutipan}}</td>
                                        <td>{{$quote->sumber}}</td>
                                        <td>
                                        <a href="{{route('edit', $quote->id)}}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                                        <form action="{{route('destroy', $quote->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete" class="btn btn-danger" data-original-title="Remove" onclick="return confirm('Hapus Data ini?')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="5">
                                            tidak ada data
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
@stop