<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#030712] text-slate-100 font-sans p-6 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-xl bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-2xl mx-auto">
        <div class="flex items-center justify-between border-b border-slate-800 pb-4 mb-4">
            <h2 class="text-xl font-bold text-emerald-400">¡Requerimiento Finalizado!</h2>
            <span class="text-xs bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20 font-semibold">SIGER</span>
        </div>

        <p class="text-slate-300 mb-6">El requerimiento ha sido registrado como finalizado exitosamente.</p>

        <div class="bg-slate-950/60 rounded-xl p-4 border border-slate-800 space-y-3 mb-6">
            <div class="flex justify-between text-sm items-start gap-4">
                <span class="text-slate-400 shrink-0">Requerimiento:</span>
                <span class="text-slate-200 font-medium text-right">
                    {{ $desarrollo->requerimiento->Descripcion ?? 'Sin descripción disponible' }}
                </span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400">ID Requerimiento:</span>
                <span class="font-mono text-slate-200">#{{ $desarrollo->IdRequerimiento }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-slate-400">Fecha de Entrega:</span>
                <span class="text-slate-200">{{ now()->format('d/m/Y') }}</span>
            </div>
            <div class="pt-2 border-t border-slate-800">
                <span class="text-slate-400 text-xs block mb-1">Novedad / Observación:</span>
                <p class="text-slate-200 text-sm italic bg-slate-900 p-2.5 rounded-lg border border-slate-800/80">{{ $novedad }}</p>
            </div>
        </div>

        <p class="text-xs text-slate-500 text-center">Notificación automática generada por el sistema SIGER.</p>
    </div>
</body>
</html>