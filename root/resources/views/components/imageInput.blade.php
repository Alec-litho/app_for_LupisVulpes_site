
<!--В компоненты можно передовать как аттрибуты так и пропсы, если передовать параметр в пропсы то в атрибуте компонента его не будет
без @ props -> <div class="load-image w-100 d-flex justify-content-center w-50" required="required"></div>
c @ props -> <div class="load-image w-100 d-flex justify-content-center w-50"></div>

-->
<!--@ props(['required']) if parameter is set 
    @ props(['required => false']) if parameter is not set we can set value by default
--> 

<!--
    $slot -> это весь контент, который находится внутри компонента, но если нужно отдельный кусок кода передать через другую переменную $slot
    то нужно написать весь этот контент в компоненте <x-slot name="additionalContent"></x-slot>  name -> это название переменной через которую
    будет передоваться весь контент
-->

@props(['required' => false])

<div class="load-image w-100 d-flex justify-content-center w-50" {{$attributes->class([$required? 'required' : 'none'])}}>
    <div class="di">
        {{$slot}}
    </div>
</div>