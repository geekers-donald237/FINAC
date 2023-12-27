public function addFicheArm(Request $request)
{
try {
$uuid = Uuid::uuid4();
$permissionPortUid = Uuid::uuid4();
$weaponUid = Uuid::uuid4();

// Holders Data
$requestData = $request->only(['fullname', 'telephone', 'email', 'profession', 'weapon_type']);

$validator = Validator::make($requestData, [
'fullname' => 'required',
'telephone' => 'required',
'weapon_type' => 'required',
'email' => 'required|email',
'profession' => 'required',
]);

if ($validator->fails()) {
throw new \Exception('Veuillez remplir tous les champs');
}

$weaponType = WeaponType::find($requestData['weapon_type']);

if (!$weaponType || $weaponType->quantity <= 0) {
throw new \Exception('La quantité d\'armes est épuisée.');
}

$firstAvailableWeapon = Weapon::where('weapon_type_id', $requestData['weapon_type'])
->whereNull('holder_id')
->first();

if (!$firstAvailableWeapon) {
throw new \Exception('Aucun numéro de série disponible pour ce type d\'arme.');
}

$holder_weapon = new HoldersWeapon();
$uploadedFilesCount = 0;

$fileFields = ['holder_weapons_picture', 'identity_number', 'buy_permission', 'honor_contract'];

foreach ($fileFields as $field) {
if ($request->hasFile($field)) {
$filename = HelpersFunction::handleFileUpload($request->file($field), "public/finac/{$field}/");
$holder_weapon->$field = $filename;
$uploadedFilesCount++;
}
}

if ($uploadedFilesCount !== count($fileFields)) {
throw new \Exception('Veuillez télécharger tous les fichiers requis.');
}

$holder_weapon->id = $uuid->toString();
$holder_weapon->fill($requestData);

// Décrémenter la quantité
$weaponType->quantity--;
$weaponType->save();

$holder_weapon->save();

$firstAvailableWeapon->holder_id = $uuid->toString();
$firstAvailableWeapon->save();

$port_request = new PermissionsPort();
$port_request->id = $permissionPortUid->toString();
$port_request->holder_id = $uuid->toString();
$port_request->weapon_id = $firstAvailableWeapon->id;
$port_request->date_demande = now();
$port_request->save();

toastr()->success('Fiche d\'arme ajoutée');
return redirect()->route('armory.index');
} catch (\Exception $e) {
dd($e->getMessage());
// En cas d'erreur, affichage de messages et redirection
toastr()->error($e->getMessage());
return redirect()->back();
}
}
