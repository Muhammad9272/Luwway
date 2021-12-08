					

						<div class="item-filter">

							<ul class="filter-list">
								<li class="item-short-area">
										<p>{{$langg->lang64}} :</p>
						<select id="sortby" name="sort" class="short-item">
	                    <option  value="date_desc" {{($sort=='date_desc')?'selected':''}}>{{$langg->lang65}}</option>
	                    <option   value="date_asc" {{($sort=='date_asc')?'selected':''}}>{{$langg->lang66}}</option>
	                    <option  value="price_asc" {{($sort=='price_asc')?'selected':''}}>{{$langg->lang67}}</option>
	                    <option value="price_desc" {{($sort=='price_desc')?'selected':''}}>{{$langg->lang68}}</option>
										</select>
								</li>
							</ul>
						</div>
