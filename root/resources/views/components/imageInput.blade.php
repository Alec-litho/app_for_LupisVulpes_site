
<!--В компоненты можно передовать как аттрибуты так и пропсы, если передовать параметр в пропсы то в атрибуте компонента его не будет
без @ props -> <div class="load-image w-100 d-flex justify-content-center w-50" required="required"></div>
c @ props -> <div class="load-image w-100 d-flex justify-content-center w-50"></div>

-->
<!--@ props(['required']) if parameter is set 
    @ props(['required => false']) if parameter is not set we can set value by default
--> 
@props(['required' => false])

<div class="load-image w-100 d-flex justify-content-center w-50" {{$attributes->class([$required? 'required' : 'none'])}}>
    <div class="di">
        {{$slot}}
    </div>
</div>