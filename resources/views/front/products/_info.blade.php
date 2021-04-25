<div class="col-md-4">
    <div class="card border">
        <div class="card-body">
            <p><span>@lang('name'): </span>&nbsp;{{ auth()->user()->name }}</p>
            <p><span>@lang('email'): </span>&nbsp;{{ auth()->user()->email }}</p>
            @if (auth()->user()->contacts)
            <div class="my-1">
                <small class="fw-bold text-danger">@lang('attribute_address_select_note')</small>
            </div>
            <div class="row border rounded mb-2 py-1">
                @foreach (auth()->user()->contacts as $key => $contact)
                <div class="d-flex pt-1">
                    <div class="row">
                        <label for="address-{{ $contact->id }}">@lang('phone'): &nbsp;{{ $contact->phone }}</label>
                        <label for="address-{{ $contact->id }}">@lang('address')-@lang($key+1): &nbsp;{{ $contact->address }}</label>
                    </div>
                    <input type="checkbox" name="address" value="{{ $contact->id }}"
                        onchange="contactCheck({{ $contact->id }})" id="address-{{ $contact->id }}"
                        class="form-check-input">
                </div>
                @endforeach
            </div>
            @endif
            <form action="{{ route('front.contacts.store-user') }}" method="post">
                <div class="my-1">
                    <small class="fw-bold text-danger">@lang('attribute_address_create_note')</small>
                </div>
                <div class="row border rounded py-2">
                    @csrf
                    <div class="mb-1">
                        <label for="phone" class="form-label">@lang('phone')</label>
                        <input type="text" name="phone" id="phone" value="" class="form-control form-control-sm"
                            placeholder="@lang('enter_phone')">
                    </div>
                    <div class="mb-1">
                        <label for="home_street" class="form-label">@lang('home_street')</label>
                        <input type="text" name="home_street" id="home_street" value=""
                            class="form-control form-control-sm" placeholder="@lang('enter_home_street')">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="state" class="form-label">@lang('state')</label>
                        <select id="state" name="state" class="form-select form-select-sm" aria-label="form-select-sm">
                            <option value="">@lang('select_states')</option>
                            @foreach ($states as $state)
                            <option value="{{ $state['key'] }}"
                                {{ (old('state') == $state['key']) ? 'selected=selected' : '' }}
                                title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="city" class="form-label">@lang('city')</label>
                        <select id="city" name="city" class="form-select form-select-sm" aria-label="form-select-sm">
                            <option value="">@lang('select_citites')</option>
                            {{-- @foreach ($states as $state)
                                <option value="{{ $state['key'] }}"
                            {{ (old('state') == $state['key']) ? 'selected=selected' : '' }}
                            title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="township" class="form-label">@lang('township')</label>
                        <select id="township" name="township" class="form-select form-select-sm"
                            aria-label="form-select-sm">
                            <option value="">@lang('select_townships')</option>
                            {{-- @foreach ($states as $state)
                                <option value="{{ $state['key'] }}"
                            {{ (old('state') == $state['key']) ? 'selected=selected' : '' }}
                            title="{{ $state['name'] }}">{{ $state['name'] }}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-sm bg-theme text-light rounded">@lang('create')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
