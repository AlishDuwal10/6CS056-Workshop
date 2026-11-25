<div class="field">
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{ old('name', $student->name ?? '') }}">
</div>
<div class="field">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $student->email ?? '') }}">
</div>
<div class="field">
    <label for="phone">Phone</label>
    <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone ?? '') }}">
</div>
<div class="field">
    <label for="address">Address</label>
    <textarea id="address" name="address">{{ old('address', $student->address ?? '') }}</textarea>
</div>
<div class="field">
    <label for="date_of_birth">Date of Birth</label>
    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth ?? '') }}">
</div>