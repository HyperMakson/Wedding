<?php require __DIR__ . "/header.php"; ?>
<tr>
    <td style="padding: 32px 16px; font-size: 16px; line-height: 1.5; color: #333;">
        <h1 style="font-size: 20px; line-height: 1.5;">Подтверждённое приглашение на свадьбу <span style="font-weight: bold; color: #99AC79;">Максима и Вики</span></h1>
        <p style="margin-bottom: 5px;">
            Гость: <span style="font-weight: bold; color: #99AC79;"><?= $this->mailData["name"] ?? ""; ?></span>
        </p>
        <ul style="margin-top: 5px;">
            <li>Присутствие: <span style="font-weight: bold; color: #99AC79;"><?= isset($this->mailData["presense"]) ? ($this->mailData["presense"] ? "✅" : "❌") : ""; ?></span></li>
            <li>Имя: <span style="font-weight: bold; color: #99AC79;"><?= $this->mailData["name"] ?? ""; ?></span></li>
            <li>Телефон: <span style="font-weight: bold; color: #99AC79;"><?= $this->mailData["phone"] ?? ""; ?></span></li>
            <li>Почта: <span style="font-weight: bold; color: #99AC79;"><?= $this->mailData["email"] ?? ""; ?></span></li>
            <li>Алкоголь: <span style="font-weight: bold; color: #99AC79;"><?= $this->mailData["alcohol"] ?? ""; ?></span></li>
        </ul>
    </td>
</tr>
<?php require __DIR__ . "/footer.php"; ?>