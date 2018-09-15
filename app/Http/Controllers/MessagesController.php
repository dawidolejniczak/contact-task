<?php

namespace App\Http\Controllers;

use App\Entities\Message;
use App\Mail\SendMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\MessageRepository;
use App\Validators\MessageValidator;

/**
 * Class MessagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MessagesController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * @var MessageValidator
     */
    protected $messageValidator;

    /**
     * MessagesController constructor.
     *
     * @param MessageRepository $messageRepository
     * @param MessageValidator $messageValidator
     */
    public function __construct(MessageRepository $messageRepository, MessageValidator $messageValidator)
    {
        $this->messageRepository = $messageRepository;
        $this->messageValidator = $messageValidator;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $messages = $this->messageRepository->all();

        return view('messages.index', compact('messages'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('messages.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $this->messageValidator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            /**
             * @var Message $message
             */
            $message = $this->messageRepository->create($request->all());

            Mail::to($message->email)
                ->send(new SendMessage($message));

            Mail::to(env('MAIL_ADMIN'))
                ->send(new SendMessage($message));

            return redirect()->route('messages.index')->with('message', trans('messages.message_created'));
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}
