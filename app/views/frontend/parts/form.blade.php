@if($form = Form::byTag('contact'))
<div class="contact-form">
    <form method="post" action="/forms/submit/{{ $form->tag }}" class="ajax contact-form__form">
        {{ FForm::message() }}
        {{ $form->token }}
        @foreach ($form->controls as $num_con => $control)
        <div class="contact-form__row">
            @if($control->type == 'textarea')
            <div class="contact-form__col">
                <textarea class="contact-form__form-control contact-form__form-control--textarea" name="{{ $control->name }}" id="{{ $control->name }}" placeholder="{{ CMS::trans($control->label) }}{{ $control->isRequired ? ' *' : '' }}" {{ $control->type }}></textarea>
            </div>
            @else
            <div class="contact-form__col">
                <input class="contact-form__form-control" name="{{ $control->name }}" id="{{ $control->name }}" placeholder="{{ CMS::trans($control->label) }}{{ $control->isRequired ? ' *' : '' }}" type="{{ $control->type }}" {{ $control->rules }} />
            </div>
            @endif
        </div>
        @endforeach
        {{ Honeypot::generate('my_name', 'my_time') }}
        <div class="contact-form__row js-bottom-offset-val">
            <div class="contact-form__col">
                <button type="submit" class="contact-form__button button"><span class="button__text">{{ CMS::trans('send_message') }}</span></button>
                <span class="contact-form__label">* {{ CMS::trans('fields_required') }}</span>
            </div>
        </div>
    </form>
</div>
@endif
