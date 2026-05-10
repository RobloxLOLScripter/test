package com.trixx1.stretchres.client.gui;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.gui.DrawContext;
import net.minecraft.client.gui.screen.Screen;
import net.minecraft.client.gui.widget.ButtonWidget;
import net.minecraft.client.gui.widget.SliderWidget;
import net.minecraft.client.gui.widget.TextFieldWidget;
import net.minecraft.text.Text;
import net.minecraft.util.Identifier;
import net.minecraft.util.math.MathHelper;

public class StretchScreen extends Screen {
    private static final Identifier HENTAI_1 = Identifier.of("stretchres", "textures/gui/hentai1.png");
    private static final Identifier HENTAI_2 = Identifier.of("stretchres", "textures/gui/hentai2.png");

    private TextFieldWidget profileNameField;
    private float time = 0;

    public StretchScreen() {
        super(Text.literal("StretchRes Ultimate"));
    }

    @Override
    protected void init() {
        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // --- STRETCH ---
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 120, 200, 20, Text.literal("Stretch Factor"), (StretchConfig.currentProfile.stretchFactor - 0.1) / 9.9) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§6§lSTRETCH: §f" + String.format("%.2f", StretchConfig.currentProfile.stretchFactor))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.stretchFactor = 0.1 + this.value * 9.9; }
        });

        // --- SWING ---
        int swingY = centerY - 95;
        this.addDrawableChild(ButtonWidget.builder(Text.literal("§dSwing: " + (StretchConfig.currentProfile.noHandSwing ? "§cOFF" : "§aON")), button -> {
            StretchConfig.currentProfile.noHandSwing = !StretchConfig.currentProfile.noHandSwing;
            button.setMessage(Text.literal("§dSwing: " + (StretchConfig.currentProfile.noHandSwing ? "§cOFF" : "§aON")));
        }).dimensions(centerX - 100, swingY, 65, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§bStyle: " + (StretchConfig.currentProfile.oldSwing ? "§e1.8" : "§fModern")), button -> {
            StretchConfig.currentProfile.oldSwing = !StretchConfig.currentProfile.oldSwing;
            button.setMessage(Text.literal("§bStyle: " + (StretchConfig.currentProfile.oldSwing ? "§e1.8" : "§fModern")));
        }).dimensions(centerX - 30, swingY, 65, 20).build());

        this.addDrawableChild(new SliderWidget(centerX + 40, swingY, 60, 20, Text.literal("Speed"), StretchConfig.currentProfile.swingSpeed / 5.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§bSpd: §f" + String.format("%.1f", StretchConfig.currentProfile.swingSpeed))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.swingSpeed = this.value * 5.0; }
        });

        this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 72, 200, 18, Text.literal("Smoothness"), (StretchConfig.currentProfile.swingSmoothness - 0.1) / 4.9) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§3SMOOTHNESS: §f" + String.format("%.1f", StretchConfig.currentProfile.swingSmoothness))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.swingSmoothness = 0.1 + this.value * 4.9; }
        });

        // --- POSITION ---
        int posRelY = -50;
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY + posRelY, 60, 18, Text.literal("X"), (StretchConfig.currentProfile.viewmodelX + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eX: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelX))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelX = -2.0 + this.value * 4.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX - 30, centerY + posRelY, 60, 18, Text.literal("Y"), (StretchConfig.currentProfile.viewmodelY + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eY: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelY))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelY = -2.0 + this.value * 4.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX + 40, centerY + posRelY, 60, 18, Text.literal("Z"), (StretchConfig.currentProfile.viewmodelZ + 2) / 4.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§eZ: §f" + String.format("%.1f", StretchConfig.currentProfile.viewmodelZ))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelZ = -2.0 + this.value * 4.0; }
        });

        // --- ROTATION ---
        int rotRelY = -30;
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY + rotRelY, 60, 18, Text.literal("P"), (StretchConfig.currentProfile.viewmodelPitch + 180) / 360.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§aP: §f" + (int)StretchConfig.currentProfile.viewmodelPitch)); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelPitch = -180.0 + this.value * 360.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX - 30, centerY + rotRelY, 60, 18, Text.literal("Y"), (StretchConfig.currentProfile.viewmodelYaw + 180) / 360.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§aY: §f" + (int)StretchConfig.currentProfile.viewmodelYaw)); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelYaw = -180.0 + this.value * 360.0; }
        });
        this.addDrawableChild(new SliderWidget(centerX + 40, centerY + rotRelY, 60, 18, Text.literal("R"), (StretchConfig.currentProfile.viewmodelRoll + 180) / 360.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§aR: §f" + (int)StretchConfig.currentProfile.viewmodelRoll)); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelRoll = -180.0 + this.value * 360.0; }
        });

        // --- SCALE ---
        this.addDrawableChild(new SliderWidget(centerX - 100, centerY - 10, 135, 18, Text.literal("Scale"), StretchConfig.currentProfile.viewmodelScale / 2.0) {
            @Override protected void updateMessage() { this.setMessage(Text.literal("§3SCALE: §f" + String.format("%.2f", StretchConfig.currentProfile.viewmodelScale))); }
            @Override protected void applyValue() { StretchConfig.currentProfile.viewmodelScale = this.value * 2.0; }
        });
        this.addDrawableChild(ButtonWidget.builder(Text.literal("§5Hide: " + (StretchConfig.currentProfile.hideHand ? "§aON" : "§cOFF")), button -> {
            StretchConfig.currentProfile.hideHand = !StretchConfig.currentProfile.hideHand;
            button.setMessage(Text.literal("§5Hide: " + (StretchConfig.currentProfile.hideHand ? "§aON" : "§cOFF")));
        }).dimensions(centerX + 40, centerY - 10, 60, 18).build());

        // --- PROFILES ---
        this.profileNameField = new TextFieldWidget(this.textRenderer, centerX - 100, centerY + 18, 140, 18, Text.literal("Profile Name"));
        this.profileNameField.setText(StretchConfig.currentProfileName);
        this.addDrawableChild(this.profileNameField);

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§a§lSAVE"), button -> {
            StretchConfig.saveProfile(this.profileNameField.getText());
        }).dimensions(centerX + 45, centerY + 18, 55, 18).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§e§lLOAD"), button -> {
            StretchConfig.loadProfile(this.profileNameField.getText());
            this.clearAndInit();
        }).dimensions(centerX - 100, centerY + 40, 95, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§c§lRESET"), button -> {
            StretchConfig.currentProfile = new StretchConfig.Profile();
            this.clearAndInit();
        }).dimensions(centerX + 5, centerY + 40, 95, 20).build());

        this.addDrawableChild(ButtonWidget.builder(Text.literal("§f§lDONE"), button -> {
            StretchConfig.saveProfile(StretchConfig.currentProfileName);
            this.close();
        }).dimensions(centerX - 100, centerY + 65, 200, 20).build());
    }

    @Override
    public void render(DrawContext context, int mouseX, int mouseY, float delta) {
        this.time += delta;
        this.renderBackground(context, mouseX, mouseY, delta);

        int centerX = this.width / 2;
        int centerY = this.height / 2;

        // Animated RGB-ish Glow
        float r = (MathHelper.sin(time * 0.05F) + 1.0F) / 2.0F;
        float g = (MathHelper.sin(time * 0.05F + 2.0F) + 1.0F) / 2.0F;
        float b = (MathHelper.sin(time * 0.05F + 4.0F) + 1.0F) / 2.0F;
        int borderColor = 0xFF000000 | (int)(r * 255) << 16 | (int)(g * 255) << 8 | (int)(b * 255);

        // Glass Panel
        context.fillGradient(0, 0, this.width, this.height, 0x88000000 | (borderColor & 0xFFFFFF), 0x00000000);
        context.fillGradient(centerX - 165, 2, centerX + 165, this.height - 2, 0xF5050505, 0xF5111111);

        // Rainbow Border
        context.fill(centerX - 165, 2, centerX - 163, this.height - 2, borderColor);
        context.fill(centerX + 163, 2, centerX + 165, this.height - 2, borderColor);
        context.fill(centerX - 165, 2, centerX + 165, 4, borderColor);
        context.fill(centerX - 165, this.height - 4, centerX + 165, this.height - 2, borderColor);

        // Hentai Pictures with Borders
        try {
            context.fill(3, centerY - 112, 147, centerY + 112, borderColor);
            context.drawTexture(HENTAI_1, 5, centerY - 110, 0, 0, 140, 220, 140, 220);

            context.fill(this.width - 147, centerY - 112, this.width - 3, centerY + 112, borderColor);
            context.drawTexture(HENTAI_2, this.width - 145, centerY - 110, 0, 0, 140, 220, 140, 220);
        } catch (Exception e) {}

        super.render(context, mouseX, mouseY, delta);

        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§l§bSTRETCHRES §f§lULTIMATE"), centerX, 8, 0xFFFFFFFF);
        context.drawCenteredTextWithShadow(this.textRenderer, Text.literal("§d§lMade by trixx1_"), centerX, this.height - 18, 0xFFFFFFFF);
    }
}
