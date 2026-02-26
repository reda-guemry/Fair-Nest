<!DOCTYPE html>
<html>
<head>
    <title>Invitation Fair-Nest</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 20px;">
    
    <div style="max-width: 600px; background: white; padding: 20px; border-radius: 8px; margin: auto;">
        <h2>Bonjour {{ $invitation->name ?? 'l\'ami(e)' }},</h2>
        
        <p>Vous avez été invité(e) à rejoindre une colocation sur <strong>Fair-Nest</strong>.</p>
        
        <p>Pour accepter l'invitation et rejoindre vos colocataires, veuillez cliquer sur le bouton ci-dessous :</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/invitations/accept?token=' . $invitation->token) }}" 
               style="background-color: #4F46E5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">
               Rejoindre la colocation
            </a>
        </div>

        <p><i>Attention: Ce lien expirera le {{ \Carbon\Carbon::parse($invitation->expires_at)->format('d/m/Y à H:i') }}.</i></p>

        <p>À bientôt,<br>L'équipe Fair-Nest</p>
    </div>

</body>
</html>