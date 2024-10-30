<x-app-layout xmlns:livewire="http://www.w3.org/1999/html">
    <!--start page wrapper -->
    <div class="page-wrapper">
        <livewire:product.product-show :product="$product" :color="$color" :similar_products="$similar_products" :key="$product->id"/>
    </div>
    <!--end page wrapper -->
</x-app-layout>

