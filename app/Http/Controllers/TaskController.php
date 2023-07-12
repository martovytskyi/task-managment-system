<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     *
     * @return View
     */
    public function index(): View
    {
        $tasks = Task::where('user_id', auth()->id())->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return View
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validator = $this->validateTaskData($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $task = new Task();
        $task->user_id = $user->id;
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status') ?? Task::NOT_STARTED;
        $task->deadline = $request->input('deadline');
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Завдання успішно створено.');
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param Task $task
     * @return View|Response
     * @throws AuthorizationException
     */
    public function edit(Task $task): View|Response
    {
        if ($task->user_id !== auth()->id()) {
            return response()->view('tasks.unauthorized', [], 403);
        }

        $this->authorize('view', $task);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $validator = $this->validateTaskData($request->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status') ?? Task::NOT_STARTED;
        $task->deadline = $request->input('deadline');
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Завдання успішно оновлено.');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param Task $task
     * @return RedirectResponse
     */
    public function remove(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Завдання успішно видалено.');
    }

    /**
     * Validate the task data.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateTaskData(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'description' => 'required',
            'deadline' => 'date',
        ]);
    }
}
