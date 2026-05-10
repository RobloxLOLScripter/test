package com.trixx1.stretchres.mixin;

import com.trixx1.stretchres.StretchConfig;
import net.minecraft.client.render.item.HeldItemRenderer;
import net.minecraft.client.util.math.MatrixStack;
import net.minecraft.util.Arm;
import org.spongepowered.asm.mixin.Mixin;
import org.spongepowered.asm.mixin.injection.At;
import org.spongepowered.asm.mixin.injection.Inject;
import org.spongepowered.asm.mixin.injection.ModifyVariable;
import org.spongepowered.asm.mixin.injection.callback.CallbackInfo;
import org.joml.Quaternionf;

@Mixin(HeldItemRenderer.class)
public class HeldItemRendererMixin {
    @Inject(method = "applySwingOffset", at = @At("HEAD"), cancellable = true)
    private void onApplySwingOffset(MatrixStack matrices, Arm arm, float swingProgress, CallbackInfo ci) {
        if (StretchConfig.currentProfile.noHandSwing) {
            ci.cancel();
        }
    }

    @ModifyVariable(method = "applySwingOffset", at = @At("HEAD"), ordinal = 0, argsOnly = true)
    private float modifySwingProgress(float swingProgress) {
        return (float) (swingProgress * StretchConfig.currentProfile.swingSpeed);
    }

    @Inject(method = "applyEquipOffset", at = @At("HEAD"))
    private void onApplyEquipOffset(MatrixStack matrices, Arm arm, float equipProgress, CallbackInfo ci) {
        float x = (float) StretchConfig.currentProfile.viewmodelX;
        float y = (float) StretchConfig.currentProfile.viewmodelY;
        float z = (float) StretchConfig.currentProfile.viewmodelZ;
        float s = (float) StretchConfig.currentProfile.viewmodelScale;

        float pitch = (float) StretchConfig.currentProfile.viewmodelPitch;
        float yaw = (float) StretchConfig.currentProfile.viewmodelYaw;
        float roll = (float) StretchConfig.currentProfile.viewmodelRoll;

        if (arm == Arm.LEFT) {
            matrices.translate(-x, y, z);
            matrices.multiply(new Quaternionf().rotationXYZ(
                (float)Math.toRadians(pitch),
                (float)Math.toRadians(-yaw),
                (float)Math.toRadians(-roll)));
        } else {
            matrices.translate(x, y, z);
            matrices.multiply(new Quaternionf().rotationXYZ(
                (float)Math.toRadians(pitch),
                (float)Math.toRadians(yaw),
                (float)Math.toRadians(roll)));
        }

        matrices.scale(s, s, s);
    }
}
