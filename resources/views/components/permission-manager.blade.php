@if (request()->is('dashboard/permissionManager*'))
	<ul
		class="flex flex-wrap text-sm text-center container mt-3 mx-auto font-bold justify-around text-gray-500 border-b border-gray-200">
		<!-- <li class="me-2">
							<a href="{{ url('dashboard/permissionManager/warga') }}"
								aria-current="{{ request()->is('dashboard/permissionManager/warga') || request()->is('dashboard/permissionManager') ? 'page' : '' }}"
								class="py-2 px-40 w-fullfont-bold inline-block {{ request()->is('dashboard/permissionManager/warga') || request()->is('dashboard/permissionManager') ? 'text-gray-700 bg-gray-100 rounded-t-lg active' : 'text-white hover:text-gray-700 hover:bg-gray-50 rounded-t-lg' }}">
								Warga
							</a>
						</li> -->
		<li class="me-2">
			<a href="{{ url('dashboard/permissionManager/operator') }}"
				aria-current="{{ request()->is('dashboard/permissionManager/operator') ? 'page' : '' }}"
				class="py-2 px-40 font-bold inline-block p-4 {{ request()->is('dashboard/permissionManager/operator') ? 'text-gray-700 bg-gray-100 rounded-t-lg active' : 'text-white hover:text-gray-700 hover:bg-gray-50 rounded-t-lg' }}">
				Operator
			</a>
		</li>
		<li class="me-2">
			<a href="{{ url('dashboard/permissionManager/admin') }}"
				aria-current="{{ request()->is('dashboard/permissionManager/admin') ? 'page' : '' }}"
				class="py-2 px-40 ont-bold inline-block p-4 {{ request()->is('dashboard/permissionManager/admin') ? 'text-gray-700 bg-gray-100 rounded-t-lg active' : 'text-white hover:text-gray-700 hover:bg-gray-50 rounded-t-lg' }}">
				Admin
			</a>
		</li>
	</ul>
@endif