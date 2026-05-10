package com.trixx1.stretchres.client.gui;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.gui.DrawContext;
import net.minecraft.client.gui.screen.Screen;
import net.minecraft.client.gui.widget.ButtonWidget;
import net.minecraft.client.gui.widget.SliderWidget;
import net.minecraft.client.gui.widget.TextFieldWidget;
import net.minecraft.text.Text;
import net.minecraft.util.Identifier;

public class StretchScreen extends Screen {
    private static final Identifier HENTAI_1 = Identifier.of("stretchres", "textures/gui/hentai1.png");
    private static final Identifier HENTAI_2 = Identifier.of("stretchres", "textures/gui/hentai2.png");

    private TextFieldWidget profileNameField;

    public StretchScreen() {
        super(Text.literal("StretchRes Ultimate"));
    }

    @Override
    protected void init() {
        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // --- STRETCH SECTION ---
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 115, 200, 20, Text.literal("Stretch Factor"), (StretchConfig.currentProfile.stretchFactor - 0.1) / 9.9) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§6§lStretch Factor: §f" + String.format("%.2f", StretchConfig.currentProfile.stretchFactor))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.stretchFactor = 0.1 + this.value * 9.9; }
        });

        // --- HAND SETTINGS ---
        this.addDrawableChild(ButtonWidget.builder(Text.literal("§dSwing: " + (StretchConfig.currentProfile.noHandSwing ? "§cOFF" : "§aON")), button -> {
            StretchConfig.currentProfile.noHandSwing = !StretchConfig.currentProfile.noHandSwing;
            button.setMessage(Text.literal("§dSwing: " + (StretchConfig.currentProfile.noHandSwing ? "§cOFF" : "§aON")));
        }).dimensions(centerX - 100, centerY - 90, 95, 20).build());

        this.addDrawableChild(new SliderWidget(centerX + 5, centerY - 90, 95, 20, Text.literal("Swing Speed"), StretchConfig.currentProfile.swingSpeed / 5.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§bSpeed: §f" + String.format("%.1f", StretchConfig.currentProfile.swingSpeed))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.swingSpeed = this.value * 5.0; }
        });

        // --- VIEWMODEL POSITION ---
        int posRelY = -65;
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY + posRelY, 60, 20, Text.literal("X"), (StretchConfig.currentProfile.viewmodelX + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eX: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelX))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelX = -2.0 + this.value * 4.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX - 30, centerY + posRelY, 60, 20, Text.literal("Y"), (StretchConfig.currentProfile.viewmodelY + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eY: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelY))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelY = -2.0 + this.value * 4.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX + 40, centerY + posRelY, 60, 20, Text.literal("Z"), (StretchConfig.currentProfile.viewmodelZ + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eZ: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelZ))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelZ = -2.0 + this.value * 4.0; }
        });

        // --- VIEWMODEL ROTATION ---
        int rotRelY = -40;
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY + rotRelY, 60, 20, Text.literal("Pitch"), (StretchConfig.currentProfile.viewmodelPitch + 180) / 360.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§aP: §f" + (int)StretchConfig.currentProfile.viewmodelPitch)); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelPitch = -180.0 + this.value * 360.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX - 30, centerY + rotRelY, 60, 20, Text.literal("Yaw"), (StretchConfig.currentProfile.viewmodelYaw + 180) / 360.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§aY: §f" + (int)StretchConfig.currentProfile.viewmodelYaw)); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelYaw = -180.0 + this.value * 360.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX + 40, centerY + rotRelY, 60, 20, Text.literal("Roll"), (StretchConfig.currentProfile.viewmodelRoll + 180) / 360.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§aR: §f" + (int)StretchConfig.currentProfile.viewmodelRoll)); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelRoll = -180.0 + this.value * 360.0; }
        });

        this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 15, 200, 20, Text.literal("Scale"), StretchConfig.currentProfile.viewmodelScale / 2.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§3§lViewmodel Scale: §f" + String.format("%.2f", StretchConfig.currentProfile.viewmodelScale))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelScale = this.value * 2.0; }
        });

        // --- PROFILE SECTION ---
        this.profileNameField = new TextFieldWidget(this.textRenderer, centerX - 100, centerY + 25, 140, 20, Text.literal("Profile Name"));
        this.profileNameField.setText(StretchConfig.currentProfileName);
        this.addDrawableChild(this.profileNameField);

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§a§lSAVE"), button -> {
            StretchConfig.saveProfile(this.profileNameField.getText());
        }).dimensions(centerX + 45, centerY + 25, 55, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§e§lLOAD"), button -> {
            StretchConfig.loadProfile(this.profileNameField.getText());
            this.clearAndInit();
        }).dimensions(centerX - 100, centerY + 50, 95, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§c§lRESET"), button -> {
            StretchConfig.currentProfile = new StretchConfig.Profile();
            this.clearAndInit();
        }).dimensions(centerX + 5, centerY + 50, 95, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§f§lDONE"), button -> {
            StretchConfig.saveProfile(StretchConfig.currentProfileName);
            this.close();
        }).dimensions(centerX - 100, centerY + 80, 200, 20).build());
    }

    @Override
    public void render(DrawContext context, int mouseX, int mouseY, float delta) {
        this.renderBackground(context, mouseX, mouseY, delta);

        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // Glass background with purple glow
        context.fillGradient(0, 0, this.width, this.height, 0x44AA00FF, 0x00000000);
        context.fillGradient(centerX - 150, 5, centerX + 150, this.height - 5, 0xEE111111, 0xEE050505);

        // Borders
        int borderColor = 0xFFAA00FF;
        context.fill(centerX - 150, 5, centerX - 148, this.height - 5, borderColor);
        context.fill(centerX + 148, 5, centerX + 150, this.height - 5, borderColor);

        // Render Pictures
        try {
            // Left picture with border
            context.fill(8, centerY - 102, 137, centerY + 102, 0xFFAA00FF);
            context.drawTexture(HENTAI_1, 10, centerY - 100, 0, 0, 125, 200, 125, 200);

            // Right picture with border
            context.fill(this.width - 137, centerY - 102, this.width - 8, centerY + 102, 0xFFAA00FF);
            context.drawTexture(HENTAI_2, this.width - 135, centerY - 100, 0, 0, 125, 200, 125, 200);
        } catch (Exception e) {}

        super.render(context, mouseX, mouseY, delta);

        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§l§bSTRETCHRES §f§lULTIMATE"), centerX, 15, 0xFFFFFFFF);
        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§d§lMade by trixx1_"), centerX, this.height - 20, 0xFFFFFFFF);
    }
}
