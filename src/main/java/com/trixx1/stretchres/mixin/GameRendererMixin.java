package com.trixx1.stretchres.mixin;

import com.trixx1.stretchres.StretchConfig;
import com.trixx1.stretchres.render.ProjectionCache;
import net.minecraft.client.render.GameRenderer;
import org.joml.Matrix4f;
import org.spongepowered.asm.mixin.Final;
import org.spongepowered.asm.mixin.Mixin;
import org.spongepowered.asm.mixin.Shadow;
import org.spongepowered.asm.mixin.injection.At;
import org.spongepowered.asm.mixin.injection.Inject;
import org.spongepowered.asm.mixin.injection.callback.CallbackInfoReturnable;
import net.minecraft.client.MinecraftClient;

@Mixin(GameRenderer.class)
public abstract class GameRendererMixin {

    @Shadow
    @Final
    private MinecraftClient client;

    @Shadow
    public abstract float getFarPlaneDistance();

    @Inject(method = "getBasicProjectionMatrix", at = @At("RETURN"), cancellable = true)
    private void onGetBasicProjectionMatrix(double fov, CallbackInfoReturnable<Matrix4f> cir) {
        if (StretchConfig.stretchFactor != 1.0) {
            float aspectRatio = (float) (this.client.getWindow().getFramebufferWidth() / (float) this.client.getWindow().getFramebufferHeight());
            aspectRatio *= StretchConfig.stretchFactor;

            Matrix4f matrix = ProjectionCache.get((float) fov, aspectRatio, this.getFarPlaneDistance());
            cir.setReturnValue(matrix);
        }
    }
}
