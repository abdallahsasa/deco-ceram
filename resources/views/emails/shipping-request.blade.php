<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <p>Bonjour,</p>
    
    <p>Je me permets de vous contacter afin d'obtenir un devis pour le transport de marchandises. Vous trouverez ci-dessous les informations relatives à cette livraison :</p>
    
    <p><strong>Lieu de chargement :</strong><br>
    Usine Caesar<br>
    Via del Canaletto 49<br>
    41042 Fiorano Modenese (MO) – Italie</p>
    
    <p><strong>Lieu de livraison :</strong><br>
    {{ $quoteRequest->address ?? 'Non spécifié' }}</p>
    
    <p><strong>Marchandise :</strong> Carrelage</p>
    
    <p><strong>Poids total :</strong> {{ $totalWeight }} kg - {{ $totalPallets }} {{ $totalPallets > 1 ? 'palettes' : 'palette' }} de carrelage</p>
    
    <p><strong>Déchargement :</strong> Aucun moyen de déchargement n'est disponible sur place. Un véhicule équipé d'un hayon ou d'un moyen de déchargement adapté est donc nécessaire.</p>
    
    <p><strong>Date souhaitée de livraison :</strong> Dès que possible.</p>
    
    <p>Je vous remercie de bien vouloir me communiquer votre meilleur tarif ainsi que votre délai estimatif de livraison.</p>
    
    <p>Dans l'attente de votre retour.</p>
    
    <p>Cordialement,<br>
    L'équipe Deco & Ceram</p>
</body>
</html>
