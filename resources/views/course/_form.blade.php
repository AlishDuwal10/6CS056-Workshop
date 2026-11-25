<div class="field">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $course->name ?? '') }}">
</div>
<div class="field">
    <label for="description">Description</label>
    <textarea id="description" name="description">{{ old('description', $course->description ?? '') }}</textarea>
</div>
<div class="field">
    <label for="duration">Duration (weeks)</label>
    <input type="number" id="duration" name="duration" min="1" value="{{ old('duration', $course->duration ?? '') }}">
</div>
<div class="field">
    <label for="fee">Fee</label>
    <input type="number" id="fee" name="fee" step="0.01" min="0" value="{{ old('fee', $course->fee ?? '') }}">
</div>
<div class="field">
    <label for="difficulty">Difficulty</label>
    @php $selected = old('difficulty', $course->difficulty ?? 'Easy'); @endphp
    <select id="difficulty" name="difficulty">
        @foreach(['Easy', 'Medium', 'Hard'] as $level)
            <option value="{{ $level }}" @selected($selected === $level)>{{ $level }}</option>
        @endforeach
    </select>
</div>
<div class="field">
    <label>
        <input type="checkbox" name="is_active" value="1"
               @checked(old('is_active', $course->is_active ?? true))>
        Currently provided (active)
    </label>
</div>