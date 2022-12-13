<div class="lg:p-1 max-w-md max-w-xl lg:my-0 my-12 mx-auto p-6">
    <h1 class="lg:text-3xl text-xl font-semibold mb-6"> Cadastro</h1>
    <p class="mb-2 text-black text-lg"> Cria rapidamente um novo universo! </p>
    <form wire:submit.prevent="register">
        <input type="text" placeholder="Nome completo" class="bg-gray-200 mb-2 shadow-none dark:bg-gray-800"
               style="border: 1px solid #d3d5d8 !important;" wire:model.lazy="name">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        <input type="text" placeholder="E-mail" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800"
               style="border: 1px solid #d3d5d8 !important;" wire:model.lazy="email">
        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        <input type="password" placeholder="Senha" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800"
               style="border: 1px solid #d3d5d8 !important;" wire:model.lazy="password">
        @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        <input type="password" placeholder="Confirme sua senha" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800"
               style="border: 1px solid #d3d5d8 !important;" wire:model.lazy="password_confirmation">
        @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
        <div class="flex justify-start my-4 space-x-1">
            <div class="checkbox">
                <input type="checkbox" id="chekcbox1" checked>
                <label for="chekcbox1"><span class="checkbox-icon"></span> Eu aceito<a href=""> Termos e Condições</a></label>
            </div>
        </div>
        <button type="submit" class="bg-gradient-to-br from-pink-500 py-3 rounded-md text-white text-xl to-red-400 w-full">Login</button>
        <div class="text-center mt-5 space-x-2">
            <p class="text-base"> Já possui uma conta? <a href="{{ route('access') }}"> Acesse! </a></p>
        </div>
    </form>
</div>
