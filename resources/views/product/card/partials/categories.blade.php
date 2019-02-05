<ul class="treeview pl-0" style="list-style: none">

	@foreach($categoryOptions as $category)
		<li {!! $loop->last ? 'class="last"' : '' !!}>
			<input type="checkbox" name="category_id[]" class="category-checkbox-field" id="cat-{!! $category->id !!}"
				   value="{!! $category->id !!}" {!! in_array($category->id, $productCategories) ? 'checked' : '' !!}>
			<label for="cat-{!! $category->id !!}" class="custom-{!! in_array($category->id, $productCategories) ? 'checked' : 'unchecked' !!}">{!! $category->name !!}</label>

			@if(count($category->children))
				<ul>
					@foreach($category->children as $subCategory)

					<li>
						<input type="checkbox" class="category-checkbox-field" name="category_id[]" id="cat-{!! $subCategory->id !!}"
							   value="{!! $subCategory->id !!}" {!! in_array($subCategory->id, $productCategories) ? 'checked' : '' !!}>
						<label for="cat-{!! $subCategory->id !!}" class="custom-{!! in_array($subCategory->id, $productCategories) ? 'checked' : 'unchecked' !!}">{!! $subCategory->name !!}</label>
					</li>
					@endforeach
				</ul>
			@endif
		</li>
	@endforeach
</ul>
