<?php

class Frontend_FormsController extends \Frontend_FrontendController
{

	public function store($tag)
	{
		if ($form = Form::byTag($tag))
		{
			// Clean input array inputs
			$sanitized = self::InputStripTags(Input::all());
		   	Input::merge($sanitized);
		   	$input = Input::all();

		   	/* validation

			// Build Validation Rules
			$rules = $this->ValidationRules($form->controls);

			// Validation
			$validation = Validator::start($input, $rules, array(), $form->FormID)->bundle('cms');
			if ($validation->fails())
				return $this->ReturnMsg(0, $validation, $ajax, $form);

			*/

			/* TODO unsubscribe newsletter

		   	// Newsletter Unsubscribe
			if (isset($input['Email']) AND isset($input['Unsubscribe']))
			{
				list($status, $message) = $this->NewsletterDismiss($input['Email']);
				return $this->ReturnMsg($status, $message, $ajax, $form);
			}
			*/

			if(isset($input['lastsubmit'])) {
				$input['lastsubmit'] = $form->submits ? count($form->submits) : $submit['lastsubmit'];
			}

			$rules = array(
			    'email'     => "required|email",
			    'my_name'   => 'honeypot',
			    'my_time'   => 'required|honeytime:5'
			);

			$validator = Validator::make($input, $rules);

			if($validator->fails()) {
				return	$this->ReturnMsg(0, 'error_form_not_found', $form);
			}

			$now = new DateTime;
			$submit = array(
				'form_id'	=>	$form->id,
				'ip' => Request::ip(),
				'language' => Language::activeLanguage(),
				'created_at'	=>	$now->format('Y-m-d H:i:s'),
				'updated_at'	=>	$now->format('Y-m-d H:i:s'),

			);

			foreach (array('firstname', 'lastname', 'name', 'email', 'message') as $field)
			{
				if (isset($input[$field]))
				{
					$submit[$field] = $input[$field];
				}
				unset($input[$field]);
			}

			// CSRF
			if (isset($input['_token']))
			{
				unset($input['_token']);
			}
			
			$submit['data'] = json_encode($input);
			$submit = FormSubmit::create($submit);

			// to client
			if ($form->confirmation && $submit->email)
			{
				$view = $this->getEmailView($form, 'confirmation');
				$data = array('submit'	=>	$submit);
				
				Mail::send($view, $data, function($message) use ($form, $submit)
				{
				    $message->to($submit->email, $submit->personalname)->subject($form->title);
				});
			}


			// to user
			if ($form->notification_email)
			{
				$view = $this->getEmailView($form, 'notification');
				$data = array('submit'	=>	$submit);

				Mail::send($view, $data, function($message) use ($form)
				{
				    $message->to($form->notification_email, $form->notification_email)->subject($form->title);
				});
			}

			/* TODO Events
	        // Main Event
	        $eventBefore = Event::fire('forms_submit', $submit);
	        // Specified Event
	        $customEvent = Event::fire('forms_submit_' . strtolower($FormType), $submit);
	        */

			// Return messages or/and redirect.
			return $this->ReturnMsg(1, 'thanks', $form);
				
		}
		return	$this->ReturnMsg(0, 'error_form_not_found', $form);

	}

	/**
	 * Input: Strip Tags/XSS Filter
	 * 
	 * @param	Array	Input array
	 */
	public static function InputStripTags($input = null)
	{
		$input = ($input) ?: Input::all();
	    $result = array();
	    foreach ($input as $key => $value) 
	    {
	        // Don't allow tags on key either
	        $key = strip_tags($key);
	 
	        // If the value is an array then recurse function call
	        if (is_array($value))
	            $result[$key] = $this->InputStripTags($value);
	        else
	            $result[$key] = strip_tags($value);
	    }
	 
	    return $result;
	}

	private function getEmailView($form, $type)
	{
		$view_path = 'frontend.emails.';
		if (\View::exists($view_path . $form->tag . '_' . $type))
		{
			$ret = $view_path . $form->tag . '_' . $type;
		}
		else
		{
			$ret = $view_path . 'default' . '_' . $type;
		}
		return $ret;
	}

	private function ReturnMsg($status, $message, $form)
	{

		$msg = trans('site.forms.' . $message);

		$redirect = ($status AND Page::byTag('redirect_'.$form->tag)) ? Page::byTag('redirect_'.$form->tag)->url : null;

		$lastsubmit = ($status AND $form->submits) ? count($form->submits) : null;
		
		if (Request::ajax()) 
			return \Response::json(array('status' => $status, 'messages' => array($msg), 'redirect' => $redirect, 'lastsubmit' => $lastsubmit));
		else
		{
			// TODO
			
		}
	}



}