<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scenity | Developer Dossier Blueprint</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700&family=Playfair+Display:ital,wght=0,400..700;1,400..700&family=JetBrains+Mono:wght=400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #fcfbf9; /* Warm, ultra-light luxury canvas background */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 30px;
        }

        /* Creative Editorial Blueprint Frame */
        .scenity-business-card {
            background: #ffffff;
            width: 100%;
            max-width: 850px; 
            border: 1px solid #111111;
            box-shadow: 12px 12px 0px #c5a880; /* Bold, artistic offset shadow for reports */
            position: relative;
            display: grid;
            grid-template-columns: 1fr 220px; 
            overflow: hidden;
        }

        /* Top Technical Status Bar Bar */
        .card-top-bar {
            grid-column: span 2;
            background: #111;
            color: #fff;
            padding: 6px 20px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6rem;
            display: flex;
            justify-content: space-between;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        .status-dot {
            color: #c5a880;
        }

        /* COLUMN 1: Main Content Section */
        .card-content-col {
            padding: 35px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Header Combo Area with Stamped Portrait Frame */
        .identity-profile-group {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .inline-pic-box {
            width: 75px;
            height: 95px; 
            border: 2px dashed #c5a880; /* Creative "pinned schematic" border */
            overflow: hidden;
            flex-shrink: 0;
            background: #faf9f6;
            padding: 3px;
        }
        .inline-pic-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .identity-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 600;
            color: #111;
            line-height: 1.2;
        }
        .identity-header p {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #c5a880;
            font-weight: 700;
            margin-top: 4px;
        }

        /* Creative Concept Split: Mapping Tech Stack directly to Scent Parameters */
        .schematic-mapping-box {
            background: #faf9f6;
            border: 1px solid #eae6e1;
            padding: 16px;
            border-radius: 2px;
        }
        .schematic-title {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .flow-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .flow-node {
            background: #fff;
            border: 1px solid #eae6e1;
            padding: 10px;
            text-align: center;
            position: relative;
        }
        .flow-node::after {
            content: '➔';
            position: absolute;
            right: -10px;
            top: 50%;
            transform: translateY(-50%);
            color: #c5a880;
            font-size: 0.7rem;
            z-index: 10;
        }
        .flow-node:last-child::after {
            content: '';
        }
        .flow-tech {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            color: #111;
            display: block;
        }
        .flow-connects {
            font-size: 0.6rem;
            text-transform: uppercase;
            color: #c5a880;
            letter-spacing: 0.5px;
            margin: 2px 0;
            display: block;
        }
        .flow-scent {
            font-size: 0.7rem;
            color: #555;
            font-weight: 500;
        }

        /* Biography Text block stylized as a Laboratory Log Entry */
        .biography-text {
            font-size: 0.825rem;
            color: #333;
            line-height: 1.6;
            text-align: justify;
            position: relative;
            padding-left: 15px;
            border-left: 2px solid #111;
        }

        /* COLUMN 2: Metadata Sidebar formatted like an official System Label */
        .card-metadata-col {
            background: #faf9f6;
            padding: 35px 24px;
            border-left: 1px dashed #eae6e1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .meta-section-group {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .meta-node {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .meta-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
        }
        .meta-value {
            font-size: 0.8rem;
            color: #111;
            font-weight: 600;
            line-height: 1.3;
        }
        
        .system-stamp {
            border: 1px dashed #c5a880;
            color: #c5a880;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.55rem;
            padding: 6px;
            text-align: center;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="scenity-business-card">
        
        <div class="card-top-bar">
            <span>System Architecture Dossier // ID: 2025148709</span>
            <span>Group: RCDCS2515B <span class="status-dot">●</span></span>
        </div>

        <div class="card-content-col">
            
            <div class="identity-profile-group">
                <div class="inline-pic-box">
                    <img src="/id pic.jpg" alt="Hamqzah Soblee">
                </div>
                <div class="identity-header">
                    <h2>Muhammad Noor Hamqzah bin Mohamad Soblee</h2>
                    <p>Full-Stack Developer & Olfactory Architect</p>
                </div>
            </div>
            
            <div class="schematic-mapping-box">
                <div class="schematic-title"><i class="fa-solid fa-circle-nodes"></i> Technical Integration Mapping</div>
                <div class="flow-grid">
                    <div class="flow-node">
                        <span class="flow-tech">Laravel / PHP</span>
                        <span class="flow-connects">Parses Engine</span>
                        <span class="flow-scent">Dynamic Sillage</span>
                    </div>
                    <div class="flow-node">
                        <span class="flow-tech">SQL System</span>
                        <span class="flow-connects">Categorizes</span>
                        <span class="flow-scent">Olfactory Notes</span>
                    </div>
                    <div class="flow-node">
                        <span class="flow-tech">Node.js</span>
                        <span class="flow-connects">Computes</span>
                        <span class="flow-scent">User Weather Context</span>
                    </div>
                </div>
            </div>

            <p class="biography-text">
                As an IT specialist specializing in Net-Centric Computing at Universiti Teknologi MARA (UiTM) Cawangan Perlis, my technical proficiency centers on building robust full-stack architectures utilizing back-end frameworks such as Laravel, Node.js, and PHP. Beyond the terminal, my deep personal immersion in the luxury fragrance world exposed to the intricate, multidimensional logic of olfactory profiles, sillage dynamics, and environmental variables. Recognizing that scent selection is a highly complex matrix of user preferences and atmospheric data, I was inspired to bridge my back-end capabilities with this passion. This project maps qualitative artisan craftsmanship into structured algorithmic pathways, engineering an intuitive, data-driven recommendation engine that simplifies fragrance discovery.
            </p>
        </div>

        <div class="card-metadata-col">
            <div class="meta-section-group">
                <div class="meta-node">
                    <span class="meta-label">Student ID</span>
                    <span class="meta-value" style="font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; color: #c5a880;">2025148709</span>
                </div>
                <div class="meta-node">
                    <span class="meta-label">Group</span>
                    <span class="meta-value">RCDCS2515B</span>
                </div>
                <div class="meta-node">
                    <span class="meta-label">Origin Institution</span>
                    <span class="meta-value">UiTM Cawangan Perlis</span>
                </div>
                <div class="meta-node">
                    <span class="meta-label">Program Name</span>
                    <span class="meta-value">Net-Centric Computing</span>
                </div>
                <div class="meta-node">
                    <span class="meta-label">Engine Build</span>
                    <span class="meta-value">Scenity Matrix v1.0</span>
                </div>
            </div>

            <div class="system-stamp">
                Verified Architecture
            </div>
        </div>

    </div>

</body>
</html>
