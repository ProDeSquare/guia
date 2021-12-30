@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('You\'re unauthorized to perform this action'))
