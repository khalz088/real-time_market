<x-app-layout>
    <div class="bg-white p-4">
    <x-bladewind::table

        exclude_columns="created_at , updated_at "
        paginated="true"
        page_size="5"
        total_label="Records :a - :b"
        show_row_numbers="true"
        pagination_style="numbers"
        :data="$category"
        show_total_pages="true"/>
    </div>
</x-app-layout>
