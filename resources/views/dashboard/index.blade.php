@extends('layouts.index')

@section('title','Dashboard')

@section('page-title','Dashboard SIPENA')

@section('content')

@if($role=='hrd')
    @include('dashboard.hrd')

@elseif($role=='pegawai')
    @include('dashboard.pegawai')

@elseif($role=='spv')
    @include('dashboard.spv')

@elseif($role=='manager')
    @include('dashboard.manager')

@endif

@endsection