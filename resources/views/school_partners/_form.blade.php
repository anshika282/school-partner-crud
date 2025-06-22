@csrf

<div class="mb-3">
    <label>School Name</label>
    <input type="text" name="school_name" value="{{ old('school_name', $schoolPartner->school_name ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Contact Person</label>
    <input type="text" name="contact_person" value="{{ old('contact_person', $schoolPartner->contact_person ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $schoolPartner->email ?? '') }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Number of Students</label>
    <input type="number" name="num_students" value="{{ old('num_students', $schoolPartner->num_students ?? 0) }}" class="form-control" required>
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control" required>
        <option value="active" @selected(old('status', $schoolPartner->status ?? '') === 'active')>Active</option>
        <option value="inactive" @selected(old('status', $schoolPartner->status ?? '') === 'inactive')>Inactive</option>
    </select>
</div>

<button type="submit" class="btn btn-success">Save</button>
<a href="{{ route('school-partners.index') }}" class="btn btn-secondary">Cancel</a>