{{-- Контент-страница (О компании / Миссия / Возможности): всё из lang genla.{page}. --}}
@php $data = (array) __('genla.'.$page); @endphp

@extends('layouts.base')

@section('title', $data['seo_title'] ?? '')
@section('description', $data['seo_description'] ?? '')

@section('content')
    <x-site-header variant="page" />

    <main class="page">
        <x-page-hero :hero="$data['hero'] ?? []" />

        <x-blocks :sections="$data['sections'] ?? []" />

        <x-footer-cta :title="$data['closing']['title'] ?? null" :lead="$data['closing']['text'] ?? null" />
    </main>
@endsection
