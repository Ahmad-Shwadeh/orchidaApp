@extends('layouts.layout')


@section('title', 'لوحة التحكم')

@section('content')
<div class="row text-center">

  {{-- عدد فعال --}}
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-primary">
      <div class="inner">
        <h3>150</h3>
        <p>عدد فعال</p>
      </div>
      <div class="icon"><i class="bi bi-check-circle-fill"></i></div>
    </div>
  </div>

  {{-- معدل الارتداد --}}
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-success">
      <div class="inner">
        <h3>53<sup class="fs-5">%</sup></h3>
        <p>معدل الارتداد</p>
      </div>
      <div class="icon"><i class="bi bi-bar-chart-line-fill"></i></div>
    </div>
  </div>

  {{-- عدد منتهي --}}
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-warning">
      <div class="inner">
        <h3>44</h3>
        <p>عدد منتهي</p>
      </div>
      <div class="icon"><i class="bi bi-x-circle-fill"></i></div>
    </div>
  </div>

  {{-- عدد مقاعد --}}
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-danger">
      <div class="inner">
        <h3>65</h3>
        <p>عدد مقاعد</p>
      </div>
      <div class="icon"><i class="bi bi-person-lines-fill"></i></div>
    </div>
  </div>

</div>
@endsection
