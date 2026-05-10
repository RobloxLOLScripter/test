package com.trixx1.stretchres.client.gui;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.gui.DrawContext;
import net.minecraft.client.gui.screen.Screen;
import net.minecraft.client.gui.widget.ButtonWidget;
import net.minecraft.client.gui.widget.SliderWidget;
import net.minecraft.text.Text;
import net.minecraft.util.Identifier;

public class StretchScreen extends Screen {
    private static final Identifier HENTAI_1 = Identifier.of("stretchres", "textures/gui/hentai1.png");
    private static final Identifier HENTAI_2 = Identifier.of("stretchres", "textures/gui/hentai2.png");

    public StretchScreen() {
        super(Text.literal("StretchRes Ultimate - trixx1_ Edition"));
    }

    @Override
    protected void init() {
        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // --- STRETCH SETTINGS ---
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 95, 200, 20, Text.literal("Stretch Factor: " + String.format("%.2f", StretchConfig.stretchFactor)), (StretchConfig.stretchFactor - 0.1) / 9.9) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§6Stretch Factor: §f" + String.format("%.2f", StretchConfig.stretchFactor))); }
            @Override protected void applyValue() { StretchConfig.stretchFactor = 0.1 + this.value * 9.9; }
        });

        // --- HAND & SWING ---
        this.addDrawableChild(ButtonWidget.builder(Text.literal("§dNo Hand Swing: " + (StretchConfig.noHandSwing ? "§aON" : "§cOFF")), button -> {
            StretchConfig.noHandSwing = !StretchConfig.noHandSwing;
            button.setMessage(Text.literal("§dNo Hand Swing: " + (StretchConfig.noHandSwing ? "§aON" : "§cOFF")));
        }).dimensions(centerX - 100, centerY - 70, 200, 20).build());

        this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 45, 200, 20, Text.literal("Swing Speed: " + String.format("%.1f", StretchConfig.swingSpeed)), StretchConfig.swingSpeed / 5.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§bSwing Speed: §f" + String.format("%.1f", StretchConfig.swingSpeed))); }
            @Override protected void applyValue() { StretchConfig.swingSpeed = this.value * 5.0; }
        });

        // --- VIEWMODEL OFFSETS ---
        int offsetStartY = centerY - 10;
        this.addDrawableChild(new SliderWidget(centerX - 100, offsetStartY, 60, 20, Text.literal("X"), (StretchConfig.viewmodelX + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eX: §f" + String.format("%.1f", StretchConfig.viewmodelX))); }
            @Override protected void applyValue() { StretchConfig.viewmodelX = -2.0 + this.value * 4.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX - 30, offsetStartY, 60, 20, Text.literal("Y"), (StretchConfig.viewmodelY + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eY: §f" + String.format("%.1f", StretchConfig.viewmodelY))); }
            @Override protected void applyValue() { StretchConfig.viewmodelY = -2.0 + this.value * 4.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX + 40, offsetStartY, 60, 20, Text.literal("Z"), (StretchConfig.viewmodelZ + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eZ: §f" + String.format("%.1f", StretchConfig.viewmodelZ))); }
            @Override protected void applyValue() { StretchConfig.viewmodelZ = -2.0 + this.value * 4.0; }
        });

        // --- VIEWMODEL SCALE ---
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY + 15, 200, 20, Text.literal("Scale: " + String.format("%.1f", StretchConfig.viewmodelScale)), StretchConfig.viewmodelScale / 2.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§3Viewmodel Scale: §f" + String.format("%.2f", StretchConfig.viewmodelScale))); }
            @Override protected void applyValue() { StretchConfig.viewmodelScale = this.value * 2.0; }
        });

        // --- CONTROLS ---
        this.addDrawableChild(ButtonWidget.builder(Text.literal("§c§lReset All"), button -> {
            StretchConfig.stretchFactor = 1.0;
            StretchConfig.noHandSwing = false;
            StretchConfig.swingSpeed = 1.0;
            StretchConfig.viewmodelX = 0.0;
            StretchConfig.viewmodelY = 0.0;
            StretchConfig.viewmodelZ = 0.0;
            StretchConfig.viewmodelScale = 1.0;
            this.clearAndInit();
        }).dimensions(centerX - 100, centerY + 45, 200, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§f§lDone"), button -> {
            this.close();
        }).dimensions(centerX - 100, centerY + 70, 200, 20).build());
    }

    @Override
    public void render(DrawContext context, int mouseX, int mouseY, float delta) {
        this.renderBackground(context, mouseX, mouseY, delta);

        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // Draw main panel background
        context.fill(centerX - 140, 5, centerX + 140, this.height - 5, 0xDD000000);
        // Draw panel border (Animated-like gradient effect placeholder)
        context.fill(centerX - 140, 5, centerX - 138, this.height - 5, 0xFFAA00FF);
        context.fill(centerX + 138, 5, centerX + 140, this.height - 5, 0xFFAA00FF);
        context.fill(centerX - 140, 5, centerX + 140, 7, 0xFFAA00FF);
        context.fill(centerX - 140, this.height - 7, centerX + 140, this.height - 5, 0xFFAA00FF);

        // Pictures (Drop files at src/main/resources/assets/stretchres/textures/gui/hentai1.png)
        try {
            context.drawTexture(HENTAI_1, 5, centerY - 110, 0, 0, 130, 220, 130, 220);
            context.drawTexture(HENTAI_2, this.width - 135, centerY - 110, 0, 0, 130, 220, 130, 220);
        } catch (Exception ignored) {}

        super.render(context, mouseX, mouseY, delta);

        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§l§dSTRETCHRES ULTIMATE"), centerX, 15, 0xFFFFFFFF);
        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§8§nViewmodel Offsets"), centerX, centerY - 25, 0xFFFFFFFF);
        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§bCreated by §l§n§btrixx1_"), centerX, this.height - 20, 0xFFFFFFFF);

        // Add a nice glow effect to the author text
        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§bCreated by §l§n§btrixx1_"), centerX + 1, this.height - 20, 0x4400FFFF);
    }
}
